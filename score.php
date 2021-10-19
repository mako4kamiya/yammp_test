<?php include("html_head.php"); ?>

<body id="score">
<?php include("header.php"); ?>

  <main class="mycontainer container">
  <?php include("main-header.php"); ?>
      
      <div class="main-body">
        <div class="total-score"></div>

        <div class="row">
          <div class="col ">
            <p class="col">出題分野</p>
          </div>
          <div class="col row aiu">
            <p class="col-1">低</p>
            <p class="col-10">正答率</p>
            <p class="col-1">高</p>
          </div>
        </div>

        <div class="row">
          <p class="col">01_問1 情報セキュリティ</p>
          <div class="oyayouso col">
            <div class="suuji"style="left: 25%;">25%</div>
            <div class="maru" style="left: 25%;"></div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <p class="col">02_問2 ソフトウェア・ハードウェア</p>
          <div class="oyayouso col">
            <div class="suuji"style="left: 25%;">25%</div>
            <div class="maru" style="left: 25%;"></div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      
      </div>
</body>
</html>