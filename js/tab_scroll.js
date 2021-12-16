'user strict';

const tabs = document.getElementById('tabs');
tabs.addEventListener('click', (e)=>{
    const toi = e.delegateTarget.id; // クリックしたタブの問題番号
    const target = document.getElementById(toi); // 対象の問題番号があるタグ
    const target_top = target.offsetTop; // 対象の問題番号があるタグのy座標
    exam_page.scroll(0, target_top);
});

const tabs2 = document.getElementById('tabs2');
tabs2.addEventListener('click', (e)=>{
    const toi = e.delegateTarget.id; // クリックしたタブの問題番号
    const target = document.getElementById(toi); // 対象の問題番号があるタグ
    const target_top = target.offsetTop; // 対象の問題番号があるタグのy座標
    exam_page.scroll(0, target_top);
});