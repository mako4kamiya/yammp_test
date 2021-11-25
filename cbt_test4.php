<?php include("html_head.php"); ?>

<body id="cbt">
<?php include("mypage_header.php"); ?>
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




<p id="timer"></p>

<script>

let countdown = function(due){
// 現在日時を取得
let now = new Date();
// 現在日時と引数dueの時間の差を取得
let rest = due.getTime() - now.getTime();
// 差の秒の値を取得
let sec = Math.floor(rest / 1000) % 60;
// 差の分の値を取得
let min = Math.floor(rest / 1000 / 60) % 60;
// 差の時間を取得
let hours = Math.floor(rest / 1000 / 60 / 60) % 24;
// 差の日付を取得
let days = Math.floor(rest / 1000 / 60 / 60 /24);
// countに差の一覧を代入
let count = [days, hours, min, sec];
// countを戻す
return count;
}
// 期日を設定
let goal = new Date();
goal.setHours(23);
goal.setMinutes(59);
goal.setSeconds(59);

// recalcの中にファンクションを変数として代入
let recalc = function(){
// counterにcountdown(goal)の結果を代入
let counter = countdown(goal);
// counterの値をhtmlのIDがtimerの場所へ表示
let time = counter[1] + ":" + counter[2] + ":" + counter[3];
document.getElementById("timer").textContent = time;
document.getElementById("timer").style.color = "white";
// refreshを実行
refresh();
}
let refresh = function(){
// 指定した(1/1000 秒)時間の後にrecalcを実行
setTimeout(recalc, 1000);
}
// recalc()を呼び出し
recalc();


  </script>


        

          <button type="button" class="btn btn-primary btn-end" data-bs-toggle="modal" data-bs-target="#modal-error">終了</button>
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