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
    // 入力エラーチェック
    if ($_POST['userName'] == '') {
      $error['userName'] = 'blank';
    }
    if ($_POST['studentNumber'] < 4 && $_POST['studentNumber'] >4) {
      $error['studentNumber'] = 'length';
    }
    if ($_POST['studentNumber'] == '') {
      $error['studentNumber'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
      $error['password'] = 'length';
    }
    if ($_POST['password'] == '') {
      $error['password'] = 'blank';
    }
  }

	// 重複アカウントのチェック
	if (empty($error)) {
		$user = $db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE studentNumber=?');
		$user->execute([$_POST['studentNumber']]);
		$record = $user->fetch();
		if ($record['cnt'] > 0) {
			$error['studentNumber'] = 'duplicate';
		}
	}

	if (empty($error) && !empty($_POST) ) {		
		$_SESSION['login'] = $_POST;
		header('Location: sinki-check.php');
    exit();
	}

  // 書き直し
  if ($_REQUEST['action'] == 'rewrite') {
    $_POST = $_SESSION['login'];
    $error['rewite'] = true;
  }

  // チェック用
  // print_r($error);
  // print_r($_POST);
  // print_r($_SESSION['user']);
?>

<style>
  html {
    overflow: hidden;
  }
</style>
<body id="sinki">

  <main class="mycontainer">
    <div class="create-header">
      <p>Create New Account</p>
      <h1>WELCOME</h1>
    </div>
    <div class="main-body">

      <form action="" method="post" class="<?php print($error ? 'was-validated' : '') ?>" novalidate>
        <div class="forms">
          <i class="col-3 fas fa-user-plus"></i>
          <input required class="col-9 flex-grow-1 form-control <?php print($error['userName'] == 'blank' ? 'is-invalid' : '') ?>" type="text" placeholder="ニックネーム" name="userName" maxlength="15" value="<?php echo htmlspecialchars($_POST['userName'], ENT_QUOTES, 'UTF-8'); ?>" />
          <i class="col-3"></i>
          <?php if ($error['userName'] == 'blank'): ?>
            <div class="col-9 invalid-feedback">* ニックネームを入力してください</div>
          <?php endif; ?>
        </div>

        <div class="forms">
          <i class="col-3 fas fa-sort-numeric-down"></i>
          <input required <?php print($error['studentNumber'] == 'duplicate' ? 'pattern=".{}"' : 'pattern=".{4}"') ?> class="col-9 flex-grow-1 form-control <?php print($error['userName'] == 'blank' ? 'is-invalid' : '') ?>" type="text" placeholder="学籍番号(4桁)" name="studentNumber" value="<?php echo htmlspecialchars($_POST['studentNumber'], ENT_QUOTES, 'UTF-8'); ?>" />
          <i class="col-3"></i>
          <?php if ($error['studentNumber'] == 'blank'): ?>
            <div class="col-9 invalid-feedback">* 学籍番号を入力してください</div>
          <?php endif; ?>
          <?php if ($error['studentNumber'] == 'length'): ?>
            <div class="col-9 invalid-feedback">* 学籍番号は4桁で入力してください</div>
          <?php endif; ?>
          <?php if ($error['studentNumber'] == 'duplicate'): ?>
            <div class="col-9 invalid-feedback">* この学籍番号はすでに登録されています</div>
          <?php endif; ?>
        </div>

        <div class="forms">
          <i class="col-3 fas fa-unlock-alt"></i>
          <input required pattern=".{4,}" class="col-9 flex-grow-1 form-control <?php print($error['userName'] == 'blank' ? 'is-invalid' : '') ?>" type="password" placeholder="Password" name="password" maxlength="20" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); ?>" />
          <i class="col-3"></i>
          <?php if ($error['password'] == 'blank'): ?>
            <div class="col-9 invalid-feedback">* パスワードを入力してください</div>
          <?php endif; ?>
          <?php if ($error['password'] == 'length'): ?>
            <div class="col-9 invalid-feedback">* パスワードは4桁以上で入力してください</div>
          <?php endif; ?>
        </div>
        
        <div class="forms">
          <i class="col-3"></i>
          <button type="submit" class="btn btn-outline-warning button_2">Submit</button>
        </div>
      </form>

    </div>
  </main>

</body>

</html>