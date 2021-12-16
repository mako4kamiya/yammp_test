<?php 
    require('dbconnect.php');
    session_start();

    if (empty($_SESSION['examName']) || empty($_SESSION['answers']) || empty($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }


    $examName = $_SESSION['examName'];
    $questions = $db->prepare('SELECT * FROM questions WHERE examName = ?');
    $questions->execute([$examName]);
    $questionCount = $questions->rowCount();

    $answers = [];
    while ($question = $questions->fetch()) {
        $selected = in_array($question['toi'], $_SESSION['answers']['selected']['必須1']) || in_array($question['toi'], $_SESSION['answers']['selected']['必須2']) || in_array($question['toi'], $_SESSION['answers']['selected']['選択1']) || in_array($question['toi'], $_SESSION['answers']['selected']['選択2']) ?  '1' :  '0';
        $userAnswer = $_SESSION['answers']['userAnswer'][$question['id']] ?  $_SESSION['answers']['userAnswer'][$question['id']] : '' ;

        $array = [
            'selected' => $selected,
            'userAnswer' => $userAnswer,
            'questionID' => $question['id']
        ];
        array_push($answers, $array);
    }


    if (isset($_POST['submit_answers'])) {
        try {
            $statement = $db->prepare('INSERT INTO answers SET selected=?, userAnswer=?, created_at=NOW(), userID=?, questionID=?');
            foreach ($answers as $answer) {
                $statement->execute([
                    $answer['selected'],
                    $answer['userAnswer'],
                    $_SESSION['user']['id'],
                    $answer['questionID']
                ]);
            }
            unset($_SESSION['examName']);
            unset($_SESSION['answers']);
            $host  = $_SERVER['HTTP_HOST'];
            $extra = 'mypage.php';
            header("Location: http://$host/$extra");
            exit();
        } catch (PDOException $e) {
            echo 'DB接続エラー： ' . $e->getMessage();
        }
    }
?>
<?php require('mypage_fecbt_pm_head.php') ?>

<body id="mypage_fecbt_pm_exam">
    <div>
        <img src="" alt="">
    </div>
    <div class="mypage_fecbt_pm_end">
        <div class="mypage_fecbt_pm_exam-header">
            <div>
                <p>
                </p>
                <p>
                </p>
                <form action="" method="post">
                    <button type="submit" class="btn" name="submit_answers">終了</button>
                </form>
            </div>
            <p><span>試験：<?php print $examName ?> 基本情報技術者試験 午後（体験版）</span><span>受験者名： <?php print($_SESSION['user']['userName']); ?></span></p>
        </div>
        <div class="mypage_fecbt_pm_end-main">
            <p>お疲れ様でした。この試験を終了します。</p>
            <p>必ず右上の[ 終 了 ]ボタンをクリックして試験を終了し、退出手続きを行ってください。</p>
        </div>
        <div class="mypage_fecbt_pm_exam-footer">
        </div>
    </div>
</body>
</html>