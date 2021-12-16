<?php

  include("html_head.php");
  require('dbconnect.php');
  session_start();

  if (!isset($_SESSION['user'])) {
    // ログイン情報が無ければログイン画面を表示する
    header('Location: login.php');
    exit();
  }

?>

<body id="edit">
<?php include("mypage_header.php"); ?>

  <main class="mycontainer container">
    <?php include("mypage_title-header.php"); ?>
    <?php
      var_export($_POST);
    ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <label  class="col-1" for="
      
      "><i class="fas fa-user-plus"></i></label>
      <button class="col-6 btn btn-normal" id="
      
      " type="button" data-bs-toggle="modal" data-bs-target="#
      
      Modal">ニックネームの変更</button>
    </div>
    <div class="row justify-content-center">
      <label  class="col-1" for="unlock-alt"><i class="fas fa-unlock-alt"></i></label>
      <button class="col-6 btn btn-normal" id="unlock-alt" type="button" data-bs-toggle="modal" data-bs-target="#unlock-altModal">パスワードの変更</button>
    </div>
    <div class="row justify-content-center">
      <label  class="col-1" for="user-minus"><i class="fas fa-user-minus"></i></label>
      <button class="col-6 btn btn-outline-warning" id="user-minus" type="button" data-bs-toggle="modal" data-bs-target="#user-minusModal">ユーザー情報の削除</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>