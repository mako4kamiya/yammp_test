'use strict';
//変数の定義
const timer = document.getElementById("timer");
console.log(timer);
let count   = 3600; //カウントダウンの数字を格納する変数
let hour    = 0;
let min     = 0; //残り時間「分」を格納する変数
let sec     = 0; //残り時間「秒」を格納する変数
let start_f = false; 
let interval;

count_start();

//スタート開始
function count_start(){
    //二度押しを防止する
    if (start_f === false) {
        //1秒毎にcont_down関数を呼び出す
        interval = setInterval(count_down,1000);
        start_f = true;
    }
}

//カウントダウンの開始
function count_down(){
    if(count === 1){
        alert('試験終了です。');
        clearInterval(interval);
    } else {
        count--;
        //Math.floor関数を使って小数点になった分を整数に変換する。
        hour = Math.floor(count / 1800);
        min = Math.floor(count / 60);
        //60秒で割ったあまりが秒となる
        sec = count % 60;
        // timer.innerHTML = ("0"+hour) + "：" + ("0"+min).slice(-2) +"：" + ("0"+sec).slice(-2);
        // timer.textContent = ("0"+hour) + "：" + ("0"+min).slice(-2) +"：" + ("0"+sec).slice(-2);
        timer.innerText = ("0"+hour) + "：" + ("0"+min).slice(-2) +"：" + ("0"+sec).slice(-2);
    }
}