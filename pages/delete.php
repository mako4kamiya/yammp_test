<?php include("html_head.php"); ?>

<body id="delete">
<?php include("header.php"); ?>

  <main class="mycontainer container">
    <?php include("main-header.php"); ?>
      <div class="main-body">
        <div class="forms">
        <i class="fas fa-user-plus"></i>
            <input class="flex-grow-1" type="text" placeholder="ニックネーム">
        </div>
        <div class="forms">
        <i class="fas fa-unlock-alt"></i>
            <input class="flex-grow-1" type="text" placeholder="Password">
        </div>
        <div class="forms">
          <button type="button" class="btn btn-outline-warning button_2">Submit</button>
        </div>

        <p>ユーザー情報の削除</p>
        <div class="forms link-2">
          <button type="button" class="btn btn-outline-warning button_3">DELETE</button>
        </div>

      </div>
</body>

</html>