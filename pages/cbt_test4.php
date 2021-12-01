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




<p id="timer" class="time-icon"></p>

<script>
//001----------javascriptの開始--------------------------------------------------
    window.onload = function(){
//002----------スタートボタンをクリックして発火--------------------------------------
            var start = document.getElementById('start');
            start.addEventListener('click',count_start, false);
//003----------ストップボタンをクリックして発火--------------------------------------
            var stop = document.getElementById("stop");
            stop.addEventListener("click",count_stop, false);
//004----------リセットボタンをクリックして発火--------------------------------------
            var reset = document.getElementById("reset");
            reset.addEventListener("click",count_reset,false);
        }     
//-----------------------------------------------------------------------------
//変数の定義---------------------------------------------------------------------
    var count   = 3600;     //カウントダウンの数字を格納する変数  3分なので180
    var hour    = 0;
    var min     = 0;       //残り時間「分」を格納する変数
    var sec     = 0;       //残り時間「秒」を格納する変数
    var start_f = false; 
    var interval;
//-----------------------------------------------------------------------------

//004----------スタート開始------------------------------------------------------
function count_start(){
//0041------------二度押しを防止する
        if (start_f === false) {
//0042------------1秒毎にcont_down関数を呼び出す
          interval = setInterval(count_down,1000);
          start_f = true;
        }
    }
//-----------------------------------------------------------------------------

//005------------カウントダウンの開始---------------------------------------------
    function count_down(){
//006--------------------------------------------------------------------------
        if(count === 1){
            var display = document.getElementById("default");
            display.style.color = 'red';
            display.innerHTML = "TIME UP!";
            clearInterval(interval);
//007-------------------------------------------------------------------------
        } else {
//008-------------------------------------------------------------------------
            count--;
//009----------Math.floor関数を使って小数点になった分を整数に変換する。---------------

            hour = Math.floor(count / 1800);
            min = Math.floor(count / 1800);
//010------------60秒で割ったあまりが秒となる-------------------------------------
            sec = count % 60;
            var count_down = document.getElementById("default");
            count_down.innerHTML = ("0"+hour) + "：" + ("0"+min) +"：" + ("0"+sec).slice(-2);
        }
    }

//006-----------ストップボタンの押下---------------------------------------
    function count_stop(){
        clearInterval(interval);
        start_f = false;
    }

//007-----------リセットボタンの押下---------------------------------------
    function count_reset(){
       clearInterval(interval);
        count = 3600;
        start_f = false;
        var count_down = document.getElementById("default");
        count_down.style.color = 'white';
        count_down.innerHTML = "02：00：00";
    }    
    </script>

    <!-----タイマーの3分を表示------------------------------------------>
    <p id="default">02：00：00</p>
<!-----スタートボタンを表示----------------------------------------->
            <button id="start">スタート</button>
<!-----ストップボタンを表示----------------------------------------->
            <button id="stop">ストップ</button>
<!-----リセットボタンを表示----------------------------------------->
            <button id="reset">リセット</button>


        

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