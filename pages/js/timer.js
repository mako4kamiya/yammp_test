
//----------javascriptの開始--------------------------------------------------
    window.onload = function(){
//----------スタートボタンをクリックして発火--------------------------------------
            var start = document.getElementById('start');
            start.addEventListener('click',count_start, false);
//----------ストップボタンをクリックして発火--------------------------------------
            var stop = document.getElementById("stop");
            stop.addEventListener("click",count_stop, false);
//----------リセットボタンをクリックして発火--------------------------------------
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

//----------スタート開始------------------------------------------------------
function count_start(){
//------------二度押しを防止する
        if (start_f === false) {
//------------1秒毎にcont_down関数を呼び出す
          interval = setInterval(count_down,1000);
          start_f = true;
        }
    }
//-----------------------------------------------------------------------------

//------------カウントダウンの開始---------------------------------------------
    function count_down(){
//--------------------------------------------------------------------------
        if(count === 1){
            var display = document.getElementById("default");
            display.style.color = 'red';
            alert('試験終了です。');
            clearInterval(interval);
//-------------------------------------------------------------------------
        } else {
//-------------------------------------------------------------------------
            count--;
//----------Math.floor関数を使って小数点になった分を整数に変換する。---------------

            hour = Math.floor(count / 1800);
            min = Math.floor(count / 60);
//------------60秒で割ったあまりが秒となる-------------------------------------
            sec = count % 60;
            var count_down = document.getElementById("default");
            count_down.innerHTML = ("0"+hour) + "：" + ("0"+min).slice(-2) +"：" + ("0"+sec).slice(-2);
        }
    }

//-----------ストップボタンの押下---------------------------------------
    function count_stop(){
        clearInterval(interval);
        start_f = false;
    }

//-----------リセットボタンの押下---------------------------------------
    function count_reset(){
       clearInterval(interval);
        count = 3600;
        start_f = false;
        var count_down = document.getElementById("default");
        count_down.style.color = 'white';
        count_down.innerHTML = "02：00：00";
    }    