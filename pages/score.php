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
      if (password_verify($user['id'], $_COOKIE['user'])) {
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['studentNumber'] = $user['studentNumber'];
        $_SESSION['user']['userName'] = $user['userName'];
      }
    }
  }

  $user_answers  = $db->prepare("SELECT * FROM answers JOIN questions ON questionID = questions.id WHERE userID = ? GROUP BY created_at");
  $user_answers ->execute([$_SESSION['user']['id']]);
  $user_answer = $user_answers->fetch();
  if (empty($_POST)) {
    $created_at = $user_answer['created_at'];
    $examName = $user_answer['examName'];
  } else {
    $created_at = $_POST['created_at'];
    $examName = $_POST['examName'];
  }

  $scores = $db->prepare('SELECT * FROM score WHERE userID = ? AND created_at= ?');
  $scores->execute([
    $_SESSION['user']['id'],
    $created_at
  ]);
  
?>

<body id="score">
<?php include("header.php"); ?>

  <main class="mycontainer container">
  <div class="main-body row">

  
      <?php include("main-header.php"); ?>

      <div class="total-score"></div>

      <div class="score_kirikae">
        <div class="dropend">
          <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            スコア履歴
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php
                $user_answers  = $db->prepare("SELECT * FROM answers JOIN questions ON questionID = questions.id WHERE userID = ? GROUP BY created_at");
                $user_answers ->execute([$_SESSION['user']['id']]);
            ?>
            <?php while($user_answer = $user_answers->fetch()) : ?>
              <li>
                <form action="" name="<?php printf("scores%d",$user_answer[0]) ?>" method="post">
                  <input type="text" name="created_at" value="<?php print $user_answer['created_at'] ?>" hidden>
                  <input type="text" name="examName" value="<?php print $user_answer['examName'] ?>" hidden>
                </form>
                <a class="dropdown-item" onclick="<?php printf("document.scores%d.submit()",$user_answer[0]) ?>"><?php printf("%s %s",$user_answer['examName'], $user_answer['created_at']) ?></a>
              </li>
            <?php endwhile ?>
          </ul>
        </div>
        <h2><?php print $examName ?> <small><?php print $created_at ?></small></h2>
      </div>

      <div class="container">
        <div class="score-top row">
          <div class="col">
            <p class="col">出題分野</p>
          </div>
          <div class="col row aiu">
            <p class="col-1">低</p>
            <p class="col-10">正答率</p>
            <p class="col-1">高</p>
          </div>
        </div>

      <div class="score-all">
          <?php
            // echo '<div style="display: flex; width: fit-content">';
            //   while ($score = $scores->fetch()) {
            //     echo '<pre>';
            //     var_export($score);
            //     echo '</pre>';
            //   }
            // echo '</div>';
          ?>

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
      </div>

  </div>
  </main>

  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>