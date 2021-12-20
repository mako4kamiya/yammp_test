'user strict';

const tab = document.getElementById('tab-必須');
tab.addEventListener('click', (e)=>{
    const toi = e.delegateTarget.id; // クリックしたタブの問題番号
    const target = document.getElementById(toi); // 対象の問題番号があるタグ
    const target_top = target.offsetTop; // 対象の問題番号があるタグのy座標
    exam_page.scroll(0, target_top);
});

const tab1 = document.getElementById('tab-選択1');
tab1.addEventListener('click', (e)=>{
    const toi = e.delegateTarget.id; // クリックしたタブの問題番号
    const target = document.getElementById(toi); // 対象の問題番号があるタグ
    const target_top = target.offsetTop; // 対象の問題番号があるタグのy座標
    exam_page.scroll(0, target_top);
});
const tab2 = document.getElementById('tab-選択2');
tab2.addEventListener('click', (e)=>{
    const toi = e.delegateTarget.id; // クリックしたタブの問題番号
    const target = document.getElementById(toi); // 対象の問題番号があるタグ
    const target_top = target.offsetTop; // 対象の問題番号があるタグのy座標
    exam_page.scroll(0, target_top);
});