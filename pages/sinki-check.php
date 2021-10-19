<?php 
  include("html_head.php");
  require('../dbconnect.php');
  session_start();

  print_r($_SESSION['user']);

  // ログイン情報があればマイページを表示する
  if (isset($_SESSION['user'])) {
    header('Location: mypage.php');
    exit();
  } else if ($_COOKIE["user"]){
    // Cookieにユーザー情報があれば、自動でログイン処理を行って、
    // マイページ画面を表示する。
    $statement = $db->prepare('SELECT * FROM users');
    $statement->execute();
    while ($user = $statement->fetch()) {
      if (password_verify($user['id'], $_COOKIE['yammp_test'])) {
        $_SESSION['user']['studentNumber'] = $user['studentNumber'];
        $_SESSION['user']['userName'] = $user['userName'];
        header('Location: mypage.php');
        exit();
      }
    }
  }
  
  if (!empty($_POST)) {
    // 登録処理をする
    $statement = $db->prepare('INSERT INTO users SET studentNumber=?, userName=?, password=?, created_at = NOW(), updated_at = NOW()');
    echo $ret = $statement->execute([
      $_SESSION['user']['studentNumber'],
      $_SESSION['user']['userName'],
      password_hash($_SESSION['user']['password'], PASSWORD_DEFAULT),
    ]);
    // unset($_SESSION['user']);
  
    header('Location: mypage.php');
    exit();
  }
?>

<body id="sinki">
  <main class="mycontainer">
    <form action="" method="post">
      <input type="hidden" name="action" value="submit" />
      <div class="main-body">
        <div>記入した内容を確認して、「登録する」ボタンをクリックしてください</div>
        <div>studentNumber：<?php echo htmlspecialchars($_SESSION['user']['studentNumber'], ENT_QUOTES, 'UTF-8'); ?></div>
        <div>userName：<?php echo htmlspecialchars($_SESSION['user']['userName'], ENT_QUOTES, 'UTF-8'); ?></div>
        <div>password：【表示されません】</div>
        <button type="submit" class="btn btn-outline-warning button_2">Submit</button>
      </div>
    </form>
  </main>

</body>

</html>