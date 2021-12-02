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
    $statement = $db->prepare('SELECT * FROM questions WHERE examName = ? GROUP BY toi');
    $statement->execute([$examName]);
    $mondaisu = $statement->rowCount();
    
    $sentaku_kigou = array("ア", "イ", "ウ", "エ", "オ", "カ", "キ", "ク", "ケ", "コ",);

    $questions = $db->prepare('SELECT * FROM questions WHERE examName = ? AND toi = ?');

    $fieldNames = $db->prepare('SELECT fieldName FROM questions WHERE examName = "令和元年度秋期" AND toi = ?');

    if (!empty($_POST)) {
        // 選択した問題数
        $sentakuGroup1; $sentakuGroup2;
        for ($i = 0; $i < count($_POST['selected']); $i++) { 
            if (key($_POST['selected'][$i]) == '選択1') {
                $sentakuGroup1++;
            } elseif (key($_POST['selected'][$i]) == '選択2') {
                $sentakuGroup2++;
            }
        }
        if ($sentakuGroup1 < 4 || $sentakuGroup2 < 1) {
            $error['selected'] = 'not_enough';
        } else {
            $error['selected'] = 'ok' ;
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
        <?php include('mypage_fecbt_pm/'. $examFileName .'/t1.php') ?> <!-- 問題の表示 -->
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
                <li>
                    <a class="nav-link active" data-bs-toggle="tab" href= "#info">i</a>
                </li>
                <li>
                    <a class="nav-link " data-bs-toggle="tab" href= "#hissyu_1" role="tab">1</a>
                </li>
                <l">
                    <a class="nav-link" data-bs-toggle="tab" href= "#sentaku_1" role="tab">2-7</a>
                </li>
                <li>
                    <a class="nav-link" data-bs-toggle="tab" href= "#hissyu_2" role="tab">8</a>
                </li>
                <li>
                    <a class="nav-link" data-bs-toggle="tab" href= "#sentaku_2" role="tab">7-11</a>
                </li>
            </ul>
            <div class="tab-content">
                <form action="" method="post" name="answers">
                    <!-- info -->
                    <div class="tab-pane fade show active" id="info">
                        <p>ここに説明</p>
                    </div>
                    <!-- 必修1 -->
                    <div class="tab-pane fade" id="hissyu_1" role="tabpanel">
                        <input  id="selected_1" name="selected" value="1" class="form-check-input" type="checkbox">
                        <label for="selected_1" class="form-check-label">1</label>
                        <p>設問1aに関する解答群</p>
                        <div>
                            <div>
                                <input  id="1_1a_ア" name="userAnswer" value="ア" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1a_ア" class="btn btn-outline-dark">ア</label>
                            </div>
                            <div>
                                <input  id="1_1a_イ" name="userAnswer" value="イ" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1a_イ" class="btn btn-outline-dark">イ</label>
                            </div>
                            <div>
                                <input  id="1_1a_ウ" name="userAnswer" value="ウ" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1a_ウ" class="btn btn-outline-dark">ウ</label>
                            </div>
                        </div>
                        <p>設問1bに関する解答群</p>
                        <div>
                            <div>
                                <input  id="1_1b_ア" name="userAnswer" value="ア" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1b_ア" class="btn btn-outline-dark">ア</label>
                            </div>
                            <div>
                                <input  id="1_1b_イ" name="userAnswer" value="イ" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1b_イ" class="btn btn-outline-dark">イ</label>
                            </div>
                            <div>
                                <input  id="1_1b_ウ" name="userAnswer" value="ウ" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1b_ウ" class="btn btn-outline-dark">ウ</label>
                            </div>
                        </div>
                    </div>
                    <!-- 選択1 -->
                    <div class="tab-pane fade" id="sentaku_1" role="tabpanel">
                        <div class="d-flex align-items-start" id="info" aria-labelledby="info">
                            <div class="nav flex-column nav-pills me-3" aria-orientation="vertical">
                                <a class="nav-link active" id="sentaku_1_toi_2" data-bs-toggle="pill" href="#sentaku_1_toi_2" aria-controls="sentaku_1_toi_2" >1</a>
                                <a class="nav-link" id="sentaku_1_toi_3" data-bs-toggle="pill" href="#sentaku_1_toi_3" aria-controls="sentaku_1_toi_3">2</a>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="sentaku_1_toi_2" aria-labelledby="sentaku_1_toi_2">1</div>
                                <div class="tab-pane fade" id="sentaku_1_toi_3" aria-labelledby="sentaku_1_toi_3">2</div>
                            </div>
                        </div>



                        <!-- <input  id="selected_2" name="selected" value="1" class="form-check-input" type="checkbox">
                        <label for="selected_2" class="form-check-label">この問題を選択する</label>
                        <p>設問1aに関する解答群</p>
                        <div>
                            <div>
                                <input  id="2_1a_ア" name="userAnswer" value="ア" type="radio" class="btn-check" autocomplete="off">
                                <label for="2_1a_ア" class="btn btn-outline-dark">ア</label>
                            </div>
                            <div>
                                <input  id="2_1a_イ" name="userAnswer" value="イ" type="radio" class="btn-check" autocomplete="off">
                                <label for="2_1a_イ" class="btn btn-outline-dark">イ</label>
                            </div>
                        </div>
                        <p>設問1bに関する解答群</p>
                        <div>
                            <div>
                                <input  id="2_1b_ア" name="userAnswer" value="ア" type="radio" class="btn-check" autocomplete="off">
                                <label for="2_1b_ア" class="btn btn-outline-dark">ア</label>
                            </div>
                            <div>
                                <input  id="2_1b_イ" name="userAnswer" value="イ" type="radio" class="btn-check" autocomplete="off">
                                <label for="2_1b_イ" class="btn btn-outline-dark">イ</label>
                            </div>
                        </div> -->
                    </div>
                    <!-- 必修2 -->
                    <div class="tab-pane fade" id="hissyu_2" role="tabpanel">
                        <input  id="selected_1" name="selected" value="1" class="form-check-input" type="checkbox">
                        <label for="selected_1" class="form-check-label">1</label>
                        <p>設問1aに関する解答群</p>
                        <div>
                            <div>
                                <input  id="1_1a_ア" name="userAnswer" value="ア" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1a_ア" class="btn btn-outline-dark">ア</label>
                            </div>
                            <div>
                                <input  id="1_1a_イ" name="userAnswer" value="イ" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1a_イ" class="btn btn-outline-dark">イ</label>
                            </div>
                            <div>
                                <input  id="1_1a_ウ" name="userAnswer" value="ウ" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1a_ウ" class="btn btn-outline-dark">ウ</label>
                            </div>
                        </div>
                        <p>設問1bに関する解答群</p>
                        <div>
                            <div>
                                <input  id="1_1b_ア" name="userAnswer" value="ア" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1b_ア" class="btn btn-outline-dark">ア</label>
                            </div>
                            <div>
                                <input  id="1_1b_イ" name="userAnswer" value="イ" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1b_イ" class="btn btn-outline-dark">イ</label>
                            </div>
                            <div>
                                <input  id="1_1b_ウ" name="userAnswer" value="ウ" type="radio" class="btn-check" autocomplete="off">
                                <label for="1_1b_ウ" class="btn btn-outline-dark">ウ</label>
                            </div>
                        </div>
                    </div>
                    <!-- 選択2 -->
                    <div class="tab-pane fade" id="sentaku_2" role="tabpanel">
                        <input  id="selected_2" name="selected" value="1" class="form-check-input" type="checkbox">
                        <label for="selected_2" class="form-check-label">この問題を選択する</label>
                        <p>設問1aに関する解答群</p>
                        <div>
                            <div>
                                <input  id="2_1a_ア" name="userAnswer" value="ア" type="radio" class="btn-check" autocomplete="off">
                                <label for="2_1a_ア" class="btn btn-outline-dark">ア</label>
                            </div>
                            <div>
                                <input  id="2_1a_イ" name="userAnswer" value="イ" type="radio" class="btn-check" autocomplete="off">
                                <label for="2_1a_イ" class="btn btn-outline-dark">イ</label>
                            </div>
                        </div>
                        <p>設問1bに関する解答群</p>
                        <div>
                            <div>
                                <input  id="2_1b_ア" name="userAnswer" value="ア" type="radio" class="btn-check" autocomplete="off">
                                <label for="2_1b_ア" class="btn btn-outline-dark">ア</label>
                            </div>
                            <div>
                                <input  id="2_1b_イ" name="userAnswer" value="イ" type="radio" class="btn-check" autocomplete="off">
                                <label for="2_1b_イ" class="btn btn-outline-dark">イ</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mypage_fecbt_pm_exam-footer">
        </div>
    </div>

    <?php if($error['selected'] == 'not_enough'): ?>
        <div class="modal fade show mypage_fecbt_pm_check"  tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">確認</div>
                    <div class="modal-body">
                        <p>採点の対象とする問題の選択数が足りません。</p>
                        <p>指定された数の問題を選択してください。</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn not-checked" onclick="location.href='./mypage_fecbt_pm_exam.php?action=rewrite?examName=<?php print $examName?>'">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

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
                                <?php foreach ($_SESSION['answers']['selected'] as $key => $value) : ?>
                                    <?php foreach ($value as $key_str => $value_str) : ?>
                                        <?php if(preg_match("/選択1/", $key_str)) : ?>
                                            <?php $fieldNames->execute([$value_str]); ?>
                                            <?php $fieldName = $fieldNames->fetch() ?>
                                            <p><?php printf("問%d %s", $value_str, $fieldName['fieldName']) ?></p>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            </div>
                            <div>
                                <p>7-11</p>
                                <?php foreach ($_SESSION['answers']['selected'] as $key => $value) : ?>
                                        <?php foreach ($value as $key_str => $value_str) : ?>
                                            <?php if(preg_match("/選択2/", $key_str)) : ?>
                                                <?php $fieldNames->execute([$value_str]); ?>
                                                <?php $fieldName = $fieldNames->fetch() ?>
                                                <p><?php printf("問%d %s", $value_str, $fieldName['fieldName']) ?></p>
                                            <?php endif ?>
                                        <?php endforeach ?>
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