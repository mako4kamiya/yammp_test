<?php include("html_head.php"); ?>

<body id="cbt">
<?php include("mypage_header.php"); ?>
  <main class="container">

    <!-- 1 -->
  <div class="card">
    <div class="cbt-header">
      <img src="image/header.png" alt="">
    </div>
    <div class="cbt-main">
      <h1></h1>
      <div class="siken-info">
        <p>試験名:</p>
        <p>予約番号:</p>
      </div>
        <button type="button" class="btn btn-primary btn-siken">試験開始</button>
  </div>

        <!-- ポップアップ画面(2) -->
        <div class="card">
          <div class="card-header">試験内容の確認</div>
            <div class="card-body">

            <div class="border border-dark">
              <p>姓:</p>
              <p>名:</p>
              <p>試験名:</p>
              <p>言語:</p>
            </div>

            <div class="checktext">
            <p>上記の内容が正しければ「確認」を、</p>
            <p>誤りがあれば「キャンセル」をクリックしてください。</p>
            </div>

            <div class="btn-box">
              <button type="button" class="btn btn-primary btnicon">確認</button>
              <button type="button" class="btn btn-primary btnicon1">キャンセル</button>
            </div>

            </div>
          </div>
        </div>

    </div>
  </main>

</body>

</html>