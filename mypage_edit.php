<?php

  include("html_head.php");
  require('dbconnect.php');
  session_start();

  if (!isset($_SESSION['user'])) {
    // ログイン情報が無ければログイン画面を表示する
    header('Location: login.php');
    exit();
  }

  // ニックネームの変更
  if ($_POST['changeName']) { 
    // 入力エラーチェック
    if ($_POST['userName'] == '') {
      $error['userName'] = 'blank';
    }
    if ($_POST['password'] == '') {
      $error['password'] = 'blank';
    }

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
        }
      } else {
        $_SESSION['flash'] = "パスワードが間違っています";
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
      // echo '<pre>';
      // var_export($_POST);
      // echo '</pre>';
      // echo '<pre>';
      // var_export($error);
      // echo '</pre>';
      ?>


    <!-- changeNameModal -->
    <div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="changeNameModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="" method="post">
            <div class="modal-header">
              <h5 class="modal-title" id="changeNameModalLabel">ニックネームの変更</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="userName" class="col-form-label col-form-label-sm">新しいニックネーム</label>
                <input id="userName" class="form-control" type="text" placeholder="新しいニックネーム" name="userName" maxlength="15">
              </div>
              <div class="mb-3">
                <label for="password" class="col-form-label col-form-label-sm">パスワード</label>
                <input id="password" class="form-control" type="password" placeholder="パスワード" name="password">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-normal" name="changeName" value="1">変更する</button>
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