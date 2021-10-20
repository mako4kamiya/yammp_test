<?php include("html_head.php");
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
        $_SESSION['user']['studentNumber'] = $user['studentNumber'];
        $_SESSION['user']['userName'] = $user['userName'];
        header('Location: mypage.php');
        exit();
      }
    }
  }


  if (!empty($_POST)) {
    // 入力エラーチェック
    if ($_POST['studentNumber'] == '') {
      $error['studentNumber'] = 'blank';
    }
    if ($_POST['password'] == '') {
      $error['password'] = 'blank';
    }

    if (empty($error)) {
      // 学籍番号がDBにあるか確認する
      $statement = $db->prepare('SELECT * FROM users WHERE studentNumber=?');
      $statement->bindParam(1, $_POST['studentNumber'], PDO::PARAM_INT );
      $statement->execute();
      $user = $statement->fetch();
      
      // 入力されたパスワードと、DBのパスワードを照合する
      if ($user && password_verify($_POST['password'], $user['password'])) {
        // セッションにユーザー情報を記録する
        $_SESSION['user']['studentNumber'] = $user['studentNumber'];
        $_SESSION['user']['userName'] = $user['userName'];
        
        if ($_POST['save'] == 'on') {
          // チェックが入っていれば、CookieにユーザーIDを登録する
          setcookie("user", password_hash($user['id'], PASSWORD_DEFAULT), strtotime("+1 month"));
          // setcookie("user", password_hash($user['id'], PASSWORD_DEFAULT), strtotime("+1 min"));
        }
        header('Location: mypage.php');
        exit();
      } else {
        // ログイン失敗
        $error['login'] = 'failed';
      }
    }
  }

  // エラー表示
  print('error：');
  var_export($error);
  print('<br>');

  // POSTの表示
  print('<br>');
  print('POST：');
  var_export($_POST);
  print('<br>');

  // ログインしているユーザー情報
  print('<br>');  
  print("user['id']：");
  var_export($user['id']);
  print('<br>');
  print("user['studentNumber']");
  var_export($user['studentNumber']);
  print('<br>');
  print("user['userName']");
  var_export($user['userName']);
  print('<br>');
  print("user['password']");
  var_export($user['password']);
  print('<br>');

  // セッション情報
  print('<br>');
  print('SESSION：');
  var_export($_SESSION);
  print('<br>');
  print('SESSION["user"]：');
  var_export($_SESSION['user']);
  print('<br>');

  // Cookie情報
  print('<br>');
  print('COOKIE：');
  var_export($_COOKIE);
  print('<br>');
  print('COOKIE["user"]：');
  var_export($_COOKIE['user']);
  print('<br>');
  print('COOKIE["user"]：');
  var_export(isset($_COOKIE['user']));
  print('<br>');


?>
<body id="login">
  <main class="mycontainer">
    <div class="main-header">
      <img src="image/pc.jpg" alt="" class="login-img">
    </div>
    <form action="" method="post" class="<?php print($error ? 'was-validated' : '') ?>" novalidate>
      <div class="form-inline main-body">
        <div>

          <div class="forms">
            <p>What's your account</p>
          </div>

          <div class="forms">
            <i class="fas fa-search-plus"></i>
            <div class="form-group">
              <input type="text" placeholder="学籍番号(4桁)" name="studentNumber" value="<?php echo htmlspecialchars($_POST['studentNumber'], ENT_QUOTES, 'UTF-8'); ?>" class="<?php print($error['studentNumber'] == 'blank' ? 'is-invalid' : '') ?>">
              <?php if ($error['studentNumber'] == 'blank'): ?>
                <div class="col-9 invalid-feedback">* 学籍番号を入力してください</div>
              <?php endif; ?>
            </div>
          </div>
            
          <div class="forms">
            <i class="fas fa-key"></i>
            <div class="form-group">
              <input type="password" placeholder="Password" name="password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); ?>" class="<?php print($error['password'] == 'blank' ? 'is-invalid' : '') ?>">
              <?php if ($error['password'] == 'blank'): ?>
                <div class="col-9 invalid-feedback">* パスワードを入力してください</div>
              <?php endif; ?>
            </div>
          </div>

          <div class="forms">
            <div class="form-group">
              <input id="save" type="checkbox" name="save" value="on">
              <label for="save">次回からは自動的にログインする</label>
            </div>
          </div>
    
          <div class="link-1">
            <a href="sinki.php">create new account</a>
          </div>

        </div>
        <div>
          <button type="submit" class="btn btn-outline-warning button_1">Login</button>
        </div>
      </div>
    </form>

  </main>
</body>

</html>
