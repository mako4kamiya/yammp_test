'use strict';
const exam_page = document.getElementById('exam_page');
const exam_page_children = exam_page.children[0].children
let selection;
let range;
// let this_text;
let this_node;
// let this_parent_node;
let new_node;
let old_text ;
let select_icon = document.getElementById('select_icon');


// 選択したテキストを取得する
document.addEventListener('selectionchange', () => {
    selection = document.getSelection();
    this_node = selection.anchorNode.parentNode;
});

// マウスをクリックし始めたとき
exam_page.addEventListener('mousedown', e => {
    select_icon.style.display = 'none';
    let newChild = old_text;
    let oldChild = new_node;
    let parentNode = oldChild.parentElement;
    parentNode.childNodes.forEach(child => {
        if (child == oldChild && child.style.backgroundColor != 'yellow') {
            parentNode.insertBefore(newChild, oldChild);
            parentNode.removeChild(oldChild);
        }
    });
});

// マウスをクリックしたとき
exam_page.addEventListener('click', e => {
    // クリックしたのが、選択したテキストだった時
    if (this_node.className == 'select_text') {
        let referenceNode = this_node;
        range.setStartBefore(referenceNode);
        range.setEndAfter(referenceNode);
        let text = range.toString()
        let fragment  = range.createContextualFragment(text);
        range.deleteContents();
        range.insertNode(fragment);
    }
});

// マウスを離したとき
exam_page.addEventListener('mouseup', e => {
    if (selection.toString() != '') {

        // 選択した文字列の範囲を取得
        range = selection.getRangeAt(0);

        // 選択した文字列をspanタグで囲った文字列に置き換える
        new_node = document.createElement("span");
        new_node.className = 'select_text';
        new_node.innerHTML = selection.toString();
        old_text = range.extractContents();
        range.insertNode(new_node);

        // 選択した文字列の終了地点にiconを挿入する
        select_icon.style.left = `${e.clientX + 10}px`;
        select_icon.style.top = `${e.clientY + 10}px`;
        select_icon.style.display = 'block';
    }
});

// アイコンをクリックしたとき
select_icon.addEventListener('click', e => {
    new_node.style.backgroundColor = 'Yellow';
    select_icon.style.display = 'none';
    selection.removeAllRanges();
});
