<?php include("html_head.php"); ?>

<body id="cbt">
<?php include("header.php"); ?>

  <main class="container">

    <!-- 3 -->
  <div class="card">
    <div class="style-display">
    <div class="img">
    <?php include("mondai-img.php"); ?>
    </div>
    </div>

    <div class="style-display">
    <div class="select">
      <div class="select-header">
        <div class="select-header-btn">
          <button type="button" class="btn btn-primary btn-end">終了</button>
        </div>
        <div class="select-header-simei">
          <p><span> 試験</span> : 基本情報技術者試験（午後）</p>
          <p><span>受験者名</span> : *****</p>
        </div>
      </div>
      <div class="select-main">
        <?php include("select-main.php"); ?>
      </div>
      <div class="select-footer">
      <button type="button" class="btn btn-primary btnsize">開始<span class="icon-click"></span></button>
      </div>
    </div>
    </div>
  </div>

  </main>
</body>

</html>