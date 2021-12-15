<?php
    require('dbconnect.php');
    session_start();

    if (empty($_SESSION['examName']) || empty($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }

    // 対象となる試験の「試験名」と「試験ファイル名」を取得する
    $examName = $_SESSION['examName']; // 試験名
    foreach (glob("mypage_fecbt_pm/*_fe_pm_qs/data.json") as $path) {
        $json = file_get_contents($path);
        $data = json_decode($json,true);
        if ($data['examName'] == $examName) {
            $examFileName = $data['examFileName']; // 試験ファイル名
        }
    }

    // 対象となる試験の情報を取得する
    $questions = $db->prepare('SELECT * FROM questions WHERE examName = ?');
    $questions->execute([$examName]);
    if ($questions->fetch()) {
        
            $fieldNameGroupByToi = $db->prepare('SELECT fieldName FROM questions WHERE examName = ? AND toi = ? GROUP BY toi');
            
            $groupBySentakuGroup = $db->prepare('SELECT * FROM questions WHERE examName = ? GROUP BY sentakuGroup ORDER BY toi');
            
            $whereSentakuGroup = $db->prepare('SELECT * FROM questions WHERE examName = ? AND sentakuGroup = ?');
            
            $whereSentakuGroupGroupByToi = $db->prepare('SELECT * FROM questions WHERE examName = ? AND sentakuGroup = ? GROUP BY toi');
            
            $whereSentakuGroupToi = $db->prepare('SELECT * FROM questions WHERE examName = ? AND sentakuGroup = ? AND toi = ?');
            
            $sentaku_kigou = array("ア", "イ", "ウ", "エ", "オ", "カ", "キ", "ク", "ケ", "コ",);
        
            if (!empty($_POST)) {
                // 選択した問題数チェック
                if(count($_POST['selected']['選択1']) == 4 && count($_POST['selected']['選択2']) == 1) {
                    $error['selected'] = 'ok';
                } else {
                    $error['selected'] = 'wrong_select';
                }
                $_SESSION['answers'] = $_POST;
            }
        
            // 書き直し
            if ($_REQUEST['action'] == 'rewrite') {
                $_POST = $_SESSION['answers'];
            }
        
    } else {
        header("Location: login.php");
        exit();
    }

?>
<?php require('mypage_fecbt_pm_head.php') ?>

<body id="mypage_fecbt_pm_exam">
    <div id="exam_page">
        <?php require('mypage_fecbt_pm/'. $examFileName .'/t1.php') ?> <!-- 問題の表示 -->
        <section id="t2"><h1>t2</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t3"><h1>t3</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t4"><h1>t4</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t5"><h1>t5</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t6"><h1>t6</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t7"><h1>t7</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t8"><h1>t8</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t9"><h1>t9</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t10"><h1>t10</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t11"><h1>t11</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t12"><h1>t12</h1><br><br><br><br><br><br><br><br><br><br></section>
        <section id="t13"><h1>t13</h1><br><br><br><br><br><br><br><br><br><br></section>
    </div>

    <div>
        <div class="mypage_fecbt_pm_exam-header">
            <div>
                <div></div>
                <div>
                    <p class="time-icon">全体の残り時間</p>
                    <p id="timer">02：00：00</p>
                </div>
                <div>
                    <button type="button" class="btn" onclick="document.answers.submit()">終了</button>
                </div>
            </div>
            <p><span>試験：<?php print $examName ?> 基本情報技術者試験 午後（体験版）</span><span>受験者名： <?php print($_SESSION['user']['userName']); ?></span></p>
        </div>

        <div class="mypage_fecbt_pm_exam-main">
            <ul class="nav" role="tablist" id="tabs">
                <!-- info -->
                <li>
                    <a class="nav-link active" data-bs-toggle="tab" href= "#info">i</a>
                </li>
                <!-- 問題番号のタブ -->
                <?php $groupBySentakuGroup->execute([$examName]) ?>
                <?php while($SentakuGroup = $groupBySentakuGroup->fetch()): ?>
                    <?php $whereSentakuGroupGroupByToi->execute([$examName, $SentakuGroup['sentakuGroup']])?>
                    <?php $SentakuGroupCount = $whereSentakuGroupGroupByToi->rowCount()?>
                    <li>
                        <a class="nav-link " data-bs-toggle="tab" href= "#<?php print $SentakuGroup['sentakuGroup'] ?>" role="tab" id="<?php print "t". $SentakuGroup['toi']?>"><?php  preg_match("/選択/", $SentakuGroup['sentakuGroup']) ? printf('%s-%s', $SentakuGroup['toi'], ($SentakuGroup['toi'] + $SentakuGroupCount - 1)) : print $SentakuGroup['toi'] ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
            <div class="tab-content">
                <form action="" method="post" name="answers">
                    <!-- info内容 -->
                    <div class="tab-pane fade show info active" id="info"  role="tabpanel">
                        <ul>
                            <p>問題一覧</p>
                            <li>
                                <img src="<?php print 'mypage_fecbt_pm/'. $examFileName. '/mondai.png' ?>">
                            </li>
                            <p>共通に使用される擬似言語の記述形式</p>
                            <li>
                                <p>擬似言語を使用した問題では，各問題文中に注記がない限リ，次の記述形式が適用されているものとする。</p>
                                <p><strong>〔宣言，注釈及び処理〕</strong></p>
                                <img src="image/info1.png" style="width: 60%">
                            </li>
                            <li>
                                <p><strong>〔演算子と優先順位〕</strong></p>
                                <img src="image/info2.png" style="width: 50%">
                            </li>
                            <li>
                                <p><strong>〔論理型の定数〕</strong></p>
                                <p>true, false</p>
                            </li>
                        </ul>
                    </div>
                    <!-- 問題内容 -->
                    <?php $groupBySentakuGroup->execute([$examName]) ?>
                    <?php while($SentakuGroup = $groupBySentakuGroup->fetch()): ?>
                        <div class="tab-pane fade <?php if (preg_match("/選択/", $SentakuGroup['sentakuGroup'])) print 'sentaku' ?>" id="<?php print $SentakuGroup['sentakuGroup'] ?>" role="tabpanel">
                            <?php if(preg_match("/必須/", $SentakuGroup['sentakuGroup'])): ?><!-- 必須問題 -->
                                <p>問<?php print $SentakuGroup['toi'] ?>　【必須問題】</p>
                                <input hidden id="<?php printf('toi_%s-selected', $SentakuGroup['toi']) ?>" name="<?php printf('selected[%s][]', $SentakuGroup['sentakuGroup']) ?>" value="<?php print $SentakuGroup['toi'] ?>" class="form-check-input" type="checkbox" checked>
                                <?php $whereSentakuGroup->execute([$examName, $SentakuGroup['sentakuGroup']]) ?>
                                <?php while($row = $whereSentakuGroup->fetch()): ?>
                                    <p>設問<?php print $row['setsumon'] ?>に関する解答群</p>
                                    <div>
                                        <?php for($i = 0; $i < $row['sentakushi']; $i++): ?>
                                            <div>
                                                <input  id="<?php printf('id_%s-%s-%s', $row['id'], $row['setsumon'], $sentaku_kigou[$i]) ?>" name="<?php printf('userAnswer[%s]', $row['id']) ?>" value="<?php print $sentaku_kigou[$i] ?>" type="radio" class="btn-check" <?php if (!empty($_POST['userAnswer']) && $_POST['userAnswer'][$row['id']] == $sentaku_kigou[$i]) print 'checked' ?>>
                                                <label for="<?php printf('id_%s-%s-%s', $row['id'], $row['setsumon'], $sentaku_kigou[$i]) ?>" class="btn btn-outline-dark"><?php print $sentaku_kigou[$i] ?></label>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                <?php endwhile; ?>
                            <?php elseif(preg_match("/選択/", $SentakuGroup['sentakuGroup'])): ?><!-- 選択問題 -->
                                <div class="nav flex-column nav-pills" role="tablist" id="tabs2">
                                    <?php $whereSentakuGroupGroupByToi->execute([$examName, $SentakuGroup['sentakuGroup']]) ?>
                                    <?php $i = true ?>
                                    <?php while($row = $whereSentakuGroupGroupByToi->fetch(PDO::FETCH_ASSOC)): ?>
                                        <a class="nav-link <?php if($i == true) print 'active'; $i = false ?> <?php  if (!empty($_POST['selected'][$row['sentakuGroup']]) && in_array($row['toi'], $_POST['selected'][$row['sentakuGroup']])) print 'checked'?> " data-bs-toggle="pill" href="#<?php printf('%s-%s', $row['sentakuGroup'], $row['toi']) ?>" role="tab" id="<?php print "t". $row['toi']?>"><?php print $row['toi'] ?></a>
                                    <?php endwhile; ?>
                                </div>
                                <div class="tab-content">
                                    <?php $whereSentakuGroupGroupByToi->execute([$examName, $SentakuGroup['sentakuGroup']]) ?>
                                    <?php $j = true ?>
                                    <?php while($row = $whereSentakuGroupGroupByToi->fetch(PDO::FETCH_ASSOC)): ?>
                                        <div class="tab-pane fade <?php if ($j == true) print 'show active'; $j = false ?>" id="<?php printf('%s-%s', $row['sentakuGroup'], $row['toi']) ?>" role="tabpanel">
                                            <p>問<?php print $row['toi'] ?></p>
                                            <div>
                                                <input  id="<?php printf('toi_%s-selected', $row['toi']) ?>" name="<?php printf('selected[%s][]', $row['sentakuGroup']) ?>" value="<?php print $row['toi'] ?>" class="form-check-input" type="checkbox" <?php if (!empty($_POST['selected'][$row['sentakuGroup']]) && in_array($row['toi'], $_POST['selected'][$row['sentakuGroup']])) print 'checked' ?>>
                                                <label for="<?php printf('toi_%s-selected', $row['toi']) ?>" class="form-check-label">この問題を選択する</label>
                                            </div>
                                            <?php $whereSentakuGroupToi->execute([$examName, $row['sentakuGroup'], $row['toi']]) ?>
                                            <?php while($row = $whereSentakuGroupToi->fetch()): ?>
                                                <p>設問<?php print $row['setsumon'] ?>に関する解答群</p>
                                                <div>
                                                    <?php for($i = 0; $i < $row['sentakushi']; $i++): ?>
                                                        <div>
                                                            <input  id="<?php printf('id_%s-%s-%s', $row['id'], $row['setsumon'], $sentaku_kigou[$i]) ?>" name="<?php printf('userAnswer[%s]', $row['id']) ?>" value="<?php print $sentaku_kigou[$i] ?>" type="radio" class="btn-check" <?php if (!empty($_POST['userAnswer']) && $_POST['userAnswer'][$row['id']] == $sentaku_kigou[$i]) print 'checked' ?>>
                                                            <label for="<?php printf('id_%s-%s-%s', $row['id'], $row['setsumon'], $sentaku_kigou[$i]) ?>" class="btn btn-outline-dark"><?php print $sentaku_kigou[$i] ?></label>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif ?>
                        </div>
                    <?php endwhile; ?>
                </form>
            </div>
        </div>

        <div class="mypage_fecbt_pm_exam-footer">
            <button type="button" class="btn" disabled >開始</button>
        </div>
    </div>

    <!-- 選択数が合わないときのモーダル(送信できない) -->
    <?php if($error['selected'] == 'wrong_select'): ?>
        <div class="modal fade show mypage_fecbt_pm_check"  tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">確認</div>
                    <div class="modal-body">
                        <p>採点の対象とする問題の選択数が足りないか、多すぎます。</p>
                        <p>指定された数の問題を選択してください。</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn not-checked" onclick="location.href='./mypage_fecbt_pm_exam.php?action=rewrite'">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

    <!-- 正しく選択されているときのモーダル(送信できる) -->
    <?php if($error['selected'] == 'ok') : ?>
            <div class="modal fade show mypage_fecbt_pm_check" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">確認</div>
                        <div class="modal-body">
                            <p>採点の対象として選択した問題は次のとおりであるかをご確認ください。</p>
                            <p>選択を変更する場合や回答を続ける場合には「戻る」をクリックしてください。</p>
                            <div>
                                <p>2-5</p>
                                <?php foreach ($_SESSION['answers']['selected']['選択1'] as $toi): ?>
                                    <?php $fieldNameGroupByToi->execute([$examName, $toi]) ?>
                                    <?php $fieldName = $fieldNameGroupByToi->fetch() ?>
                                    <p><?php printf("問%s %s", $toi, $fieldName['fieldName']) ?></p>
                                <?php endforeach ?>
                            </div>
                            <div>
                                <p>7-11</p>
                                <?php foreach ($_SESSION['answers']['selected']['選択2'] as $toi): ?>
                                    <?php $fieldNameGroupByToi->execute([$examName, $toi]) ?>
                                    <?php $fieldName = $fieldNameGroupByToi->fetch() ?>
                                    <p><?php printf("問%s %s", $toi, $fieldName['fieldName']) ?></p>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php $_SESSION['answers'] = $_POST; ?>
                            <button type="button" class="btn" onclick="location.href='./mypage_fecbt_pm_end.php'">試験を終了する</button>
                            <button type="button" class="btn" onclick="location.href='./mypage_fecbt_pm_exam.php?action=rewrite'">戻る</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

    <i id="select_icon"></i>

    <script src="js/timer.js"></script>

    <script>
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
    </script>

    <script>
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

    </script>
</body>
</html>