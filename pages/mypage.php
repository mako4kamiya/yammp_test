<?php
  include("html_head.php");
  require('../dbconnect.php');
  session_start();

  if (!isset($_SESSION['user'])) {
    // ログイン情報が無ければログイン画面を表示する
    header('Location: login.php');
    exit();
  }if ($_COOKIE["user"]){
    // Cookieにユーザー情報があれば、自動でログイン処理を行う。
    $statement = $db->prepare('SELECT * FROM users');
    $statement->execute();
    while ($user = $statement->fetch()) {
      if (password_verify($user['id'], $_COOKIE['yammp_test'])) {
        $_SESSION['user']['studentNumber'] = $user['studentNumber'];
        $_SESSION['user']['userName'] = $user['userName'];
      }
    }
  }
?>

<body id="mypage">
<?php include("header.php"); ?>

  <main class="mycontainer container">
    <?php include("main-header.php"); ?>
    <div class="main-body row">
      <div class="mypage-menu col-6">
      <i class="fas fa-desktop"></i>
        <button type="button" class="btn btn-success button_type1" onclick="location.href='cbt_start.php'">CBT体験する</button>
      </div>
      <div class="mypage-menu col-6">
      <i class="fas fa-medal"></i>
        <button type="button" class="btn btn-success button_type2" onclick="location.href='score.php'">スコア</button>
      </div>
      <div class="mypage-menu col-6">
      <i class="fas fa-user-cog"></i>
        <button type="button" class="btn btn-success button_type3" onclick="location.href='delete.php'">ユーザー情報編集・削除</button>
      </div>
    </div>
  </main>
</body>

</html>