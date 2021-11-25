<?php include("html_head.php");
  require('dbconnect.php');
  session_start();

    // ログアウト
    if ($_REQUEST['action'] == 'logout') {
      unset($_SESSION['user']);
      setcookie("user", time() - 3600);
      header('Location: login.php');
      exit();
    }

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
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['studentNumber'] = $user['studentNumber'];
        $_SESSION['user']['userName'] = $user['userName'];
        
        if ($_POST['save'] == 'on') {
          // チェックが入っていれば、CookieにユーザーIDを登録する
          setcookie("user", password_hash($user['id'], PASSWORD_DEFAULT), strtotime("+1 month"));
        }
        header('Location: mypage.php');
        exit();
      } else {
        // ログイン失敗
        $error['login'] = 'failed';
      }
    }
  }

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
              <label class="loglink" for="save">次回からは自動的にログインする</label>
            </div>
          </div>
    
          <div class="link-1">
            <a href="signup.php">create new account</a>
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
