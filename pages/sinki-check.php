<?php 
  include("html_head.php");
  require('../dbconnect.php');
  session_start();

  if (isset($_SESSION['user'])) {
    // ログイン情報があればマイページ画面を表示する。
    header('Location: mypage.php');
    exit();
  } else if ($_COOKIE["user"]){
    // Cookieにユーザー情報があれば、自動でログイン処理を行って、マイページ画面を表示する。
    $statement = $db->prepare('SELECT * FROM users');
    $statement->execute();
    while ($user = $statement->fetch()) {
      if (password_verify($user['id'], $_COOKIE['user'])) {
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['studentNumber'] = $user['studentNumber'];
        $_SESSION['user']['userName'] = $user['userName'];
        header('Location: mypage.php');
        exit();
      }
    }
  }
  
  if (!empty($_POST)) {
    // ユーザー登録処理をする
    $statement = $db->prepare('INSERT INTO users SET studentNumber=?, userName=?, password=?, created_at = NOW(), updated_at = NOW()');
    echo $ret = $statement->execute([
      $_SESSION['login']['studentNumber'],
      $_SESSION['login']['userName'],
      password_hash($_SESSION['login']['password'], PASSWORD_DEFAULT),
    ]);
    // 登録したIDを取得
    $statement = $db->prepare('SELECT id FROM users WHERE studentNumber = ? AND userName = ?');
    $statement->execute([
      $_SESSION['login']['studentNumber'],
      $_SESSION['login']['userName'],
    ]);
    $user_id = $statement->fetch();
    $_SESSION['user']['id'] = $user_id[0];
    $_SESSION['user']['studentNumber'] = $_SESSION['login']['studentNumber'];
    $_SESSION['user']['userName'] = $_SESSION['login']['userName'];
    unset($_SESSION['login']);
    header('Location: mypage.php');
    exit();
  }
?>

<body id="sinki" class="modal-open">
  <main class="mycontainer">

    <!-- Modal -->
    <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">以下の内容で登録してよろしいですか？</h5>
          </div>
          <form action="" method="post">
          <div class="modal-body">
              <input type="hidden" name="action" value="submit" />
              <p>ニックネーム：<?php echo htmlspecialchars($_SESSION['login']['userName'], ENT_QUOTES, 'UTF-8'); ?></p>
              <p>学籍番号：<?php echo htmlspecialchars($_SESSION['login']['studentNumber'], ENT_QUOTES, 'UTF-8'); ?></p>
              <p>password：
                
              <?php
              $pass_str = $_SESSION['login']['password']; 
            
              $password = 0;
              while($password < strlen($pass_str)){
                echo '*';
                $password += 1;
              }
              ?>

            </p>
          </div>
          <div class="modal-footer">
            <a href="sinki.php?action=rewrite">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">書き直す</button>
            </a>
            <button type="submit" class="btn btn-outline-warning button_2-1">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="main-header">
      <p>Create New Account</p>
      <h1>WELCOME</h1>
    </div>
    <div class="main-body">
      <form action="" method="post">
        <div class="forms">
          <i class="col-3 fas fa-user-plus"></i>
          <input required class="col-9 flex-grow-1 form-control" type="text" placeholder="ニックネーム"/>
          <i class="col-3"></i>
        </div>

        <div class="forms">
          <i class="col-3 fas fa-sort-numeric-down"></i>
          <input  class="col-9 flex-grow-1 form-control" type="text" placeholder="学籍番号(4桁)"/>
          <i class="col-3"></i>
        </div>

        <div class="forms">
          <i class="col-3 fas fa-unlock-alt"></i>
          <input class="col-9 flex-grow-1 form-control" type="password" placeholder="Password"/>
          <i class="col-3"></i>
        </div>
        
        <div class="forms">
          <i class="col-3"></i>
          <button type="submit" class="btn btn-outline-warning button_2">Submit</button>
        </div>
      </form>
      <div class="modal-backdrop fade show"></div>
    </div>
  </main>

</body>
</html>