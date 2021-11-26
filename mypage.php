<?php
  include("html_head.php");
  require('dbconnect.php');
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
      if (password_verify($user['id'], $_COOKIE['user'])) {
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['studentNumber'] = $user['studentNumber'];
        $_SESSION['user']['userName'] = $user['userName'];
      }
    }
  }
?>

<body id="mypage">
<?php include("mypage_fecbt_pm_select-modal.php"); ?>
<?php include("mypage_header.php"); ?>

  <main class="mycontainer container">
  <div class="main-body row">

    <?php include("mypage_title-header.php"); ?>

      <div class="mypage-menu col-6">
      <i class="fas fa-desktop"></i>
      <button type="button" class="btn btn-success button_type1" data-bs-toggle="modal" data-bs-target="#mondai-sentaku-modal">CBT体験する</button>
      <!-- <button type="button" class="btn btn-success button_type1" onclick="location.href='mypage_fecbt_pm/mypage_fecbt_pm_start.php'">CBT体験する</button> -->
      </div>
      <div class="mypage-menu col-6">
      <i class="fas fa-medal"></i>
        <button type="button" class="btn btn-success button_type2" onclick="location.href='mypage_score.php'">スコア</button>
      </div>
      <div class="mypage-menu col-6">
      <i class="fas fa-user-cog"></i>
        <button type="button" class="btn btn-success button_type3" onclick="location.href='edit.php'">ユーザー情報編集・削除</button>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>