<?php
        require('../dbconnect.php');
        session_start();
        $examName = '令和元年度秋期';

        $statement = $db->prepare('SELECT * FROM questions WHERE examName = ? GROUP BY toi');
        $statement->execute([$examName]);
        $mondaisu = $statement->rowCount();
        
        $sentaku_kigou = array("ア", "イ", "ウ", "エ", "オ", "カ", "キ", "ク", "ケ", "コ",);

        $questions = $db->prepare('SELECT * FROM questions WHERE examName = ? AND toi = ?');
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
                    <span>残り時間</span>
                    <span>00:15:00</span>
                </p>
                <button type="button" class="btn" onclick="location.href='./cbt_demo_check.php'">終了</button>
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
                <form action="">
                    <?php for($i = 1; $i <= $mondaisu; $i++) : ?>
                    <div class="tab-pane fade <?php $i === 1 ? print 'show active' : '' ?>" id="toi-<?php print $i ?>" role="tabpanel" aria-labelledby="toi-<?php print $i ?>">
                        <?php $questions->execute([$examName, $i]); ?>
                        <?php $question = $questions->fetch(); ?>

                        <?php if(!preg_match("/必修/",$question['sentakuGroup'])) : ?>
                            <input  id="selected" name="selected" value="1" class="form-check-input" type="checkbox">
                            <label for="selected" class="form-check-label">この問題を選択する</label>
                        <?php endif ?>

                        <p>問<?php print $question['toi'] ?></p>

                        <?php $questions->execute([$examName, $i]); ?>
                        <?php while($question = $questions->fetch()) : ?>
                            <p>設問<?php print $question['setsumon'] ?>に関する解答群</p>
                            <div>
                                <?php for($j = 0; $j < $question['sentakushi']; $j++) : ?>
                                    <div>
                                        <input  id="<?php print $question['id']."_". $sentaku_kigou[$j] ?>" name="<?php print $question['id'] ?>" value="<?php print $sentaku_kigou[$j] ?>" type="radio" class="btn-check" autocomplete="off">
                                        <label for="<?php print $question['id']."_". $sentaku_kigou[$j] ?>" class="btn btn-outline-dark"><?php print $sentaku_kigou[$j] ?></label>
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
</body>
</html>