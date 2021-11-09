<?php
    require('../../dbconnect.php');
    session_start();

    if (!isset($_SESSION['user'])) {
        // ログイン情報が無ければログイン画面を表示する
        $host  = $_SERVER['HTTP_HOST'];
        $extra = 'pages/login.php';
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

    $examName = '令和元年度秋期';

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
    <link rel="stylesheet" href="cbt_demo.css">
    <title>CBT体験 - デモ </title>
</head>
<body id="cbt_demo_exam">
    <div>
        <div class="mondai_img show">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0005.jpg" alt="toi-1-1">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0006.jpg" alt="toi-1-2">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0007.jpg" alt="toi-1-3">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0008.jpg" alt="toi-1-4">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0009.jpg" alt="toi-1-5">
        </div>
        <div class="mondai_img show">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0010.jpg" alt="toi-2-1">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0011.jpg" alt="toi-2-2">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0012.jpg" alt="toi-2-3">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0013.jpg" alt="toi-2-4">
            <img src="img\2019r01a_fe_pm_qs_pages-to-jpg-0014.jpg" alt="toi-2-5">
        </div>
    </div>
    <div>
        <div class="cbt_demo_exam-header">
            <div>
                <p>
                </p>
                <p>
                </p>
                <button type="button" class="btn" onclick="document.answers.submit()">終了</button>
            </div>
            <p><span>試験：<?php print $examName ?> 基本情報技術者試験 午後（体験版）</span><span>受験者名： <?php print($_SESSION['user']['userName']); ?></span></p>
        </div>
        <div class="cbt_demo_exam-main">
            <ul class="nav navs" role="tablist">
                <?php for($i = 1; $i <= $mondaisu; $i++) : ?>
                    <li role="presentation">
                        <a class="nav-link <?php $i === 1 ? print 'active' : '' ?>" data-bs-toggle="tab" href= "#toi-<?php print $i ?>" role="tab" aria-controls="toi-<?php print $i ?>" aria-selected="true"><?php print $i ?></a>
                    </li>
                <?php endfor ?>
            </ul>
            <div class="tab-content">
                <form action="" method="post" name="answers">
                    <input type="text" name="examName" value="<?php print $examName ?>" hidden>
                    <?php for($i = 1; $i <= $mondaisu; $i++) : ?>
                    <div class="tab-pane fade <?php $i === 1 ? print 'show active' : '' ?>" id="toi-<?php print $i ?>" role="tabpanel" aria-labelledby="toi-<?php print $i ?>">
                        <?php $flag_display_selected = false; ?>
                        <?php $flag_display_toi = false; ?>
                        <?php $questions->execute([$examName, $i]); ?>
                        <?php while($question = $questions->fetch()) : ?>

                            <?php if(!$flag_display_selected) : ?>
                                <?php if(preg_match("/選択1/",$question['sentakuGroup'])) : ?>
                                    <input  id="<?php printf("selected[選択1][%d]", $question['id']) ?>" name="<?php print("selected[][選択1]") ?>" value="<?php print $question['toi'] ?>" class="form-check-input" type="checkbox">
                                    <label for="<?php printf("selected[選択1][%d]", $question['id']) ?>" class="form-check-label">この問題を選択する</label>
                                <?php elseif (preg_match("/選択2/",$question['sentakuGroup'])) : ?>
                                    <input  id="<?php printf("selected[選択2][%d]", $question['id']) ?>" name="<?php print("selected[][選択2]") ?>" value="<?php print $question['toi'] ?>" class="form-check-input" type="checkbox">
                                    <label for="<?php printf("selected[選択2][%d]", $question['id']) ?>" class="form-check-label">この問題を選択する</label>
                                    <?php endif ?>
                                <?php $flag_display_selected = true; ?>
                            <?php endif ?>
                            
                            <?php if(!$flag_display_toi) : ?>
                                <p>問<?php print $question['toi'] ?></p>
                                <?php $flag_display_toi = true; ?>
                            <?php endif ?>

                            <p>設問<?php print $question['setsumon'] ?>に関する解答群</p>
                            <div>
                                <?php for($j = 0; $j < $question['sentakushi']; $j++) : ?>
                                    <div>
                                        <input  id="<?php printf("%d_%s_%s_", $question['id'], $question['setsumon'], $sentaku_kigou[$j]) ?>" name="<?php printf("userAnswer[][%d]", $question['id']) ?>" value="<?php print(htmlspecialchars($sentaku_kigou[$j], ENT_QUOTES, 'UTF-8')) ?>" type="radio" class="btn-check" autocomplete="off">
                                        <label for="<?php printf("%d_%s_%s_", $question['id'], $question['setsumon'], $sentaku_kigou[$j]) ?>" class="btn btn-outline-dark"><?php print $sentaku_kigou[$j] ?></label>
                                    </div>
                                <?php endfor ?>
                            </div>
                        <?php endwhile ?>
                    </div>
                    <?php endfor ?>
                </form>
            </div>
        </div>
        <div class="cbt_demo_exam-footer">
        </div>
    </div>

    <?php if($error['selected'] == 'not_enough'): ?>
        <div class="modal fade show cbt_demo_check"  tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">確認</div>
                    <div class="modal-body">
                        <p>採点の対象とする問題の選択数が足りません。</p>
                        <p>指定された数の問題を選択してください。</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn not-checked" onclick="location.href='./cbt_demo_exam.php?action=rewrite'">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

    <?php if($error['selected'] == 'ok') : ?>
            <div class="modal fade show cbt_demo_check" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                            <button type="button" class="btn" onclick="location.href='./cbt_demo_end.php'">試験を終了する</button>
                            <button type="button" class="btn" onclick="location.href='./cbt_demo_exam.php?action=rewrite'">戻る</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
    <?php endif; ?>

</body>
</html>