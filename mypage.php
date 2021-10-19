<?php include("html_head.php"); ?>

<body id="mypage">
<?php include("header.php"); ?>

  <main class="mycontainer container">
    <?php include("main-header.php"); ?>
    <div class="main-body row">
      <div class="mypage-menu col-6">
      <i class="fas fa-desktop"></i>
        <button type="button" class="btn btn-success button_type1">CBT体験する</button>
      </div>
      <div class="mypage-menu col-6">
      <i class="fas fa-medal"></i>
        <button type="button" class="btn btn-success button_type2">スコア</button>
      </div>
      <div class="mypage-menu col-6">
      <i class="fas fa-user-cog"></i>
        <button type="button" class="btn btn-success button_type3">ユーザー情報編集・削除</button>
      </div>
    </div>
  </main>
</body>

</html>