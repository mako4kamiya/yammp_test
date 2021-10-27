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
  $scores = $db->query('SELECT * FROM score');
?>

<body id="score">
<?php include("header.php"); ?>

  <main class="mycontainer container">
  <?php include("main-header.php"); ?>
      
      <div class="main-body">
        <div class="total-score"></div>

        <div class="row">
          <div class="col ">
            <p class="col">出題分野</p>
          </div>
          <div class="col row aiu">
            <p class="col-1">低</p>
            <p class="col-10">正答率</p>
            <p class="col-1">高</p>
          </div>
        </div>

        <div class="row">
          <p class="col">01_問1 情報セキュリティ</p>
          <div class="oyayouso col">
            <div class="suuji"style="left: 25%;">25%</div>
            <div class="maru" style="left: 25%;"></div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>

        <?php while($score = $scores->fetch()): ?>
        <div class="row">
          <p class="col"><?php print("0{$score['toi']}_問{$score['toi']} {$score['fieldName']}"); ?></p>
          <div class="oyayouso col">
            <div class="suuji"style="left: <?php printf('%d',$score['rate']) ?>%;"><?php printf('%d',$score['rate']) ?>%</div>
            <div class="maru" style="left: <?php printf('%d',$score['rate']) ?>%;"></div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: <?php printf('%d',$score['rate']) ?>%;" aria-valuenow="<?php printf('%d',$score['rate']) ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <?php endwhile ?>
      
      </div>
</body>
</html>