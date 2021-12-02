<?php include("html_head.php"); ?>

<body id="cbt">
<?php include("header.php"); ?>
<!-- Modal 正しく選択されてるとき -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="card-header">確認</div>
      <div class="modal-body">
        <p>採点の対象として選択した問題は次のとおりであるかをご確認ください。</p>
        <p>選択を変更する場合や解答を続ける場合には「戻る」をクリックしてください。</p>
        <div class="container">
          <div class="card card-btm">
            <div class="card-header select-card">
              2-5
            </div>
            <p>問2.</p>
            <p>問3.</p>
          </div>
          <div class="card card-btm">
            <div class="card-header select-card">
              7-11
            </div>
            <p>問7.</p>
          </div>
        </div>
      </div>
      <div class="modal-footer btndis">
        <button type="button" class="btn btn-primary btnsyuryo">試験を終了する</button>
        <button type="button" class="btn btn-primary btnback">戻る</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 選択されていないとき -->
<div class="modal fade" id="modal-error" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="card-header">確認</div>
      <div class="modal-body">
        <p>採点の対象とする問題の選択数が足りません。</p>
        <p>指定された数の問題を選択してください。</p>
      </div>
      <div class="toji">
        <button type="button" class="btn btn-primary btn-toji">閉じる</button>
      </div>
    </div>
  </div>
</div>



  <main class="container">

    <!-- 3 -->
  <div class="card test3-card">
    <div class="style-display">
      <div class="img-header"></div>
        <div class="img">
          <?php include("mondai-img.php"); ?>
        </div>
    </div>

    <div class="style-display">
    <div class="select">
      <div class="select-header">
        <div class="select-header-btn">



<div>
<p id="timer" class="time-icon">残り時間：</p>
</div>

    <!-----タイマーの3分を表示------------------------------------------>
    <div>
    <p id="default">02：00：00</p>
    </div>
<!-----スタートボタンを表示----------------------------------------->
            <!-- <button id="start">スタート</button> -->
<!-----ストップボタンを表示----------------------------------------->
            <!-- <button id="stop">ストップ</button> -->
<!-----リセットボタンを表示----------------------------------------->
            <button id="reset">リセット</button>


        

          <button id="stop" type="button" class="btn btn-primary btn-end" data-bs-toggle="modal" data-bs-target="#modal-error">終了</button>
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






      <button id="start" type="button" class="btn btn-primary btnsize">開始<span class="icon-click"></span></button>
      </div>
    </div>
    </div>
  </div>

  </main>

</body>

</html>