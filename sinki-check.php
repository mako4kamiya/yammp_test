<?php 
  include("html_head.php");
  require('./dbconnect.php');
  session_start();

  print_r($_SESSION['user']);

  
  if (!isset($_SESSION['user'])) {
    header('Location: index.php'); 
    exit();
  }
  
  if (!empty($_POST)) {
    // 登録処理をする
    $statement = $db->prepare('INSERT INTO users SET studentNumber=?, userName=?, password=?, created_at = NOW(), updated_at = NOW()');
    echo $ret = $statement->execute([
      $_SESSION['user']['studentNumber'],
      $_SESSION['user']['userName'],
      password_hash($_SESSION['user']['password'], PASSWORD_DEFAULT),
    ]);
    unset($_SESSION['user']);
  
    // header('Location: mypage.php');
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