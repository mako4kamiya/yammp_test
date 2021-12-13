<?php
    require('dbconnect.php');
    session_start();

    if (!isset($_SESSION['user'])) {
        // ログイン情報が無ければログイン画面を表示する
        $host  = $_SERVER['HTTP_HOST'];
        $extra = 'login.php';
        header("Location: http://$host/$extra");
        exit();
    } else if ($_COOKIE["user"]){
    // Cookieにユーザー情報があれば、自動でログイン処理を行う。
        $statement = $db->prepare('SELECT * FROM users');
        $statement->execute();
        while ($user = $statement->fetch()) {
            if (password_verify($user['id'], $_COOKIE['user'])) {
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['studentNumber'] = $user['studentNumber'];
            $_SESSION['user']['userName'] = $user['userName'];
            }
        }
    }

    // 対象となる試験の「試験名」と「試験ファイル名」を取得する
    $examName = $_SESSION['exam']['examName']; // 試験名
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

    $fieldNameGroupByToi = $db->prepare('SELECT fieldName FROM questions WHERE examName = ? AND toi = ? GROUP BY toi');
    
    $groupBySentakuGroup = $db->prepare('SELECT * FROM questions GROUP BY sentakuGroup ORDER BY toi');

    $groupByToi = $db->prepare('SELECT * FROM questions GROUP BY toi');
    
    $whereSentakuGroup = $db->prepare('SELECT * FROM questions WHERE sentakuGroup = ?');
    
    $whereSentakuGroupGroupByToi = $db->prepare('SELECT * FROM questions WHERE sentakuGroup = ? GROUP BY toi');
    
    $whereSentakuGroupToi = $db->prepare('SELECT * FROM questions WHERE sentakuGroup = ? AND toi = ?');
    
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

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/mypage_fecbt_pm.css">
    <title>CBT体験 - デモ </title>
</head>
<body id="mypage_fecbt_pm_exam">
    <div id="exam_page">
        <?php require('mypage_fecbt_pm/'. $examFileName .'/t1.php') ?> <!-- 問題の表示 -->
    </div>

    <div>
        <div class="mypage_fecbt_pm_exam-header">
            <div>
                <p>
                </p>
                <p>
                </p>
                <button type="button" class="btn" onclick="document.answers.submit()">終了</button>
            </div>
            <p><span>試験：<?php print $examName ?> 基本情報技術者試験 午後（体験版）</span><span>受験者名： <?php print($_SESSION['user']['userName']); ?></span></p>
        </div>

        <div class="mypage_fecbt_pm_exam-main">
            <ul class="nav" role="tablist">
                <!-- info -->
                <li>
                    <a class="nav-link active" data-bs-toggle="tab" href= "#info">i</a>
                </li>
                <!-- 問題番号のタブ -->
                <?php $groupBySentakuGroup->execute([]) ?>
                <?php while($SentakuGroup = $groupBySentakuGroup->fetch()): ?>
                    <?php $whereSentakuGroupGroupByToi->execute([$SentakuGroup['sentakuGroup']])?>
                    <?php $SentakuGroupCount = $whereSentakuGroupGroupByToi->rowCount()?>
                    <li>
                        <a class="nav-link " data-bs-toggle="tab" href= "#<?php print $SentakuGroup['sentakuGroup'] ?>" role="tab"><?php  preg_match("/選択/", $SentakuGroup['sentakuGroup']) ? printf('%s-%s', $SentakuGroup['toi'], ($SentakuGroup['toi'] + $SentakuGroupCount - 1)) : print $SentakuGroup['toi'] ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
            <div class="tab-content">
                <form action="" method="post" name="answers">
                    <!-- info内容 -->
                    <div class="tab-pane fade show active" id="info"  role="tabpanel">
                        <p>ここに説明</p>
                        <?php
                            echo '<pre>';
                            var_export($_POST);
                            echo '</pre>';
                        ?>
                    </div>
                    <!-- 問題内容 -->
                    <?php $groupBySentakuGroup->execute([]) ?>
                    <?php while($SentakuGroup = $groupBySentakuGroup->fetch()): ?>
                        <div class="tab-pane fade <?php if (preg_match("/選択/", $SentakuGroup['sentakuGroup'])) print 'sentaku' ?>" id="<?php print $SentakuGroup['sentakuGroup'] ?>" role="tabpanel">
                            <?php if(preg_match("/必修/", $SentakuGroup['sentakuGroup'])): ?><!-- 必修問題 -->
                                <input hidden id="<?php printf('toi_%s-selected', $SentakuGroup['toi']) ?>" name="<?php printf('selected[%s][]', $SentakuGroup['sentakuGroup']) ?>" value="<?php print $SentakuGroup['toi'] ?>" class="form-check-input" type="checkbox" checked>
                                <?php $whereSentakuGroup->execute([$SentakuGroup['sentakuGroup']]) ?>
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
                                <div class="nav flex-column nav-pills" role="tablist">
                                    <?php $whereSentakuGroupGroupByToi->execute([$SentakuGroup['sentakuGroup']]) ?>
                                    <?php $i = true ?>
                                    <?php while($row = $whereSentakuGroupGroupByToi->fetch(PDO::FETCH_ASSOC)): ?>
                                        <a class="nav-link <?php if($i == true) print 'active'; $i = false ?> <?php  if (!empty($_POST['selected'][$row['sentakuGroup']]) && in_array($row['toi'], $_POST['selected'][$row['sentakuGroup']])) print 'checked'?> " data-bs-toggle="pill" href="#<?php printf('%s-%s', $row['sentakuGroup'], $row['toi']) ?>" role="tab"><?php print $row['toi'] ?></a>
                                    <?php endwhile; ?>
                                </div>
                                <div class="tab-content">
                                    <?php $whereSentakuGroupGroupByToi->execute([$SentakuGroup['sentakuGroup']]) ?>
                                    <?php $j = true ?>
                                    <?php while($row = $whereSentakuGroupGroupByToi->fetch(PDO::FETCH_ASSOC)): ?>
                                        <div class="tab-pane fade <?php if ($j == true) print 'show active'; $j = false ?>" id="<?php printf('%s-%s', $row['sentakuGroup'], $row['toi']) ?>" role="tabpanel">
                                            <div>
                                                <input  id="<?php printf('toi_%s-selected', $row['toi']) ?>" name="<?php printf('selected[%s][]', $row['sentakuGroup']) ?>" value="<?php print $row['toi'] ?>" class="form-check-input" type="checkbox" <?php if (!empty($_POST['selected'][$row['sentakuGroup']]) && in_array($row['toi'], $_POST['selected'][$row['sentakuGroup']])) print 'checked' ?>>
                                                <label for="<?php printf('toi_%s-selected', $row['toi']) ?>" class="form-check-label">この問題を選択する</label>
                                            </div>
                                            <?php $whereSentakuGroupToi->execute([$row['sentakuGroup'], $row['toi']]) ?>
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