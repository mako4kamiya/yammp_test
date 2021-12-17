<?php

  include("html_head.php");
  require('dbconnect.php');
  session_start();

  if (!isset($_SESSION['user'])) {
    // ログイン情報が無ければログイン画面を表示する
    header('Location: login.php');
    exit();
  }

  // unset($_SESSION['flash']);

  // ニックネームの変更を送信した場合
  if ($_POST['changeName']) { 
    // 入力エラーチェック
    if ($_POST['userName'] == '') {
      $error['userName'] = 'blank';
    }
    if ($_POST['password'] == '') {
      $error['password'] = 'blank';
    }
    // エラー表示
    if ($error['userName'] == 'blank' && $error['password'] == 'blank') {
      $_SESSION['flash'] = "ニックネームの変更エラー：　新しいニックネームと現在のパスワードが空欄です";
    } elseif ($error['userName'] == 'blank') {
      $_SESSION['flash'] = "ニックネームの変更エラー：　新しいニックネームが空欄です";
    } elseif ($error['password'] == 'blank') {
      $_SESSION['flash'] = "ニックネームの変更エラー：　パスワードが空欄です";
    }
    // 入力エラーがないとき
    if (empty($error)) {
      $user = $db->prepare('SELECT * FROM users WHERE id=?');
      $user->execute([$_SESSION['user']['id']]);
      $user = $user->fetch();

      if ($user && password_verify($_POST['password'], $user['password'])) {
        try {
          $update = $db->prepare('UPDATE users set userName = ? where id = ?');
          $update->execute([$_POST['userName'], $_SESSION['user']['id']]);
        } catch (PDOException $e) {
          $e = $e->getMessage();
        } finally {
          $user = $db->prepare('SELECT * FROM users WHERE id=?');
          $user->execute([$_SESSION['user']['id']]);
          $user = $user->fetch();
          $_SESSION['user']['userName'] = $user['userName'];
          $_SESSION['flash'] = "ニックネームを変更しました";
        }
      } else {
        $_SESSION['flash'] = "パスワードが間違っています";
      }
    }
  

  // パスワードの変更を送信した場合
  } elseif ($_POST['changePassword']) {
    // 入力エラーチェック
    if ($_POST['currentPassword'] == '') {
      $error['currentPassword'] = 'blank';
    }
    if ($_POST['newPassword'] == '') {
      $error['newPassword'] = 'blank';
    } elseif (strlen($_POST['newPassword']) < 4) {
      $error['newPassword'] = 'length';
    }
    // エラー表示
    if ($error['currentPassword'] == 'blank' && $error['newPassword'] == 'blank') {
      $_SESSION['flash'] = "パスワードの変更エラー：　現在のパスワードと新しいパスワードが空欄です";
    } elseif ($error['currentPassword'] == 'blank') {
      $_SESSION['flash'] = "パスワードの変更エラー：　現在のパスワードが空欄です";
    } elseif ($error['newPassword'] == 'blank') {
      $_SESSION['flash'] = "パスワードの変更エラー：　新しいパスワードが空欄です";
    } elseif ($error['newPassword'] == 'length') {
      $_SESSION['flash'] = "パスワードの変更エラー：　新しいパスワードは4桁以上である必要があります。";
    }
    // 入力エラーがないとき
    if (empty($error)) {
      $user = $db->prepare('SELECT * FROM users WHERE id=?');
      $user->execute([$_SESSION['user']['id']]);
      $user = $user->fetch();
      if ($user && password_verify($_POST['currentPassword'], $user['password'])) {
        try {
          $update = $db->prepare('UPDATE users set password = ? where id = ?');
          $update->execute([password_hash($_POST['newPassword'], PASSWORD_DEFAULT), $_SESSION['user']['id']]);
        } catch (PDOException $e) {
          $e = $e->getMessage();
        } finally {
          $_SESSION['flash'] = "パスワードを変更しました";
        }
      } else {
        $_SESSION['flash'] = "現在のパスワードが間違っています";
      }
    }


  }

?>

<body id="edit">
<?php include("mypage_header.php"); ?>
<?php include("flash.php"); ?>

  <main class="mycontainer container">
    <?php include("mypage_title-header.php"); ?>

    <?php
      echo '<pre>pass:';
      var_export(password_verify($_POST['currentPassword'], $user['password']));
      echo '</pre>';
      echo '<pre>post:';
      var_export($_POST);
      echo '</pre>';
      echo '<pre>erroe:';
      var_export($error);
      echo '</pre>';
      ?>


    <!-- changeNameModal -->
    <div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="changeNameModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="" method="post" class="was-validated" novalidate>
            <div class="modal-header">
              <h5 class="modal-title" id="changeNameModalLabel">ニックネームの変更</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="userName" class="col-form-label col-form-label-sm">新しいニックネーム</label>
                <input id="userName" class="form-control" type="text" placeholder="新しいニックネーム" name="userName" maxlength="15" required>
              </div>
              <div class="mb-3">
                <label for="password" class="col-form-label col-form-label-sm">パスワード</label>
                <input id="password" class="form-control" type="password" placeholder="パスワード" name="password" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-normal" name="changeName" value="1">変更する</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- changePassword -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="" method="post" class="was-validated" novalidate>
            <div class="modal-header">
              <h5 class="modal-title" id="changePasswordModalLabel">パスワードの変更</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="currentPassword" class="col-form-label col-form-label-sm">現在のパスワード</label>
                <input id="currentPassword" class="form-control" type="password" placeholder="現在のパスワード" name="currentPassword" required>
              </div>
              <div class="mb-3">
                <label for="newPassword" class="col-form-label col-form-label-sm">新しいパスワード</label>
                <input id="newPassword" class="form-control" type="password" placeholder="新しいパスワード" name="newPassword" maxlength="20" required pattern=".{4,}">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-normal" name="changePassword" value="1">変更する</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <label  class="col-1" for="changeName"><i class="fas fa-user-plus"></i></label>
      <button class="col-6 btn btn-normal" id="changeName" type="button" data-bs-toggle="modal" data-bs-target="#changeNameModal">ニックネームの変更</button>
    </div>
    <div class="row justify-content-center">
      <label  class="col-1" for="changePassword"><i class="fas fa-unlock-alt"></i></label>
      <button class="col-6 btn btn-normal" id="changePassword" type="button" data-bs-toggle="modal" data-bs-target="#changePasswordModal">パスワードの変更</button>
    </div>
    <div class="row justify-content-center">
      <label  class="col-1" for="deleteUser"><i class="fas fa-user-minus"></i></label>
      <button class="col-6 btn btn-outline-warning" id="deleteUser" type="button" data-bs-toggle="modal" data-bs-target="#deleteUserModal">ユーザー情報の削除</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>