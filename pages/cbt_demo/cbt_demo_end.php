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


    $selected_array = [];
    foreach ($_SESSION['answers']['selected'] as $key => $value) {
        foreach ($value as $v) {
            array_push($selected_array, $v);
        }
    }
    $userAnswer_array = $_SESSION['answers']['userAnswer'];

    $questions = $db->prepare('SELECT * FROM questions WHERE examName =?');
    $questions->execute([$_SESSION['answers']['examName']]);
    $insertRow = $questions->rowCount();
    
    $answers = [];
    while($question = $questions->fetch()) {
        $selected = '';
        foreach ($selected_array as $key => $value) {
            if ($question['toi'] == $value) {
                $selected = 1;
                break;
            } else {
                $selected = 0;
            }
        }
        $userAnswer = '';
        if ($userAnswer_array) {
            foreach ($userAnswer_array as $key => $value) {
                foreach ($value as $k => $v) {
                    if ($question['id'] == $k) {
                        $userAnswer = $v;
                    }
                }
            }
        }
        $array = [
            'selected' => $selected,
            'userAnswer' => $userAnswer,
            'userID' => intval($_SESSION['user']['id']),
            'questionID' => intval($question['id'])
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
                    $answer['userID'],
                    $answer['questionID']
                ]);
            }
            unset($_SESSION['answers']);
            $host  = $_SERVER['HTTP_HOST'];
            $extra = 'pages/mypage.php';
            header("Location: http://$host/$extra");
            exit();
        } catch (PDOException $e) {
            echo 'DB接続エラー： ' . $e->getMessage();
        }
    
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
        <img src="" alt="">
    </div>
    <div class="cbt_demo_end">
        <div class="cbt_demo_exam-header">
            <div>
                <p>
                </p>
                <p>
                </p>
                <form action="" method="post">
                    <button type="submit" class="btn" name="submit_answers">終了</button>
                </form>
            </div>
            <p><span>試験：プロメトリック認定試験（体験版）</span><span>受験者名： 試験 太郎</span></p>
        </div>
        <div class="cbt_demo_end-main">
            <p>お疲れ様でした。この試験を終了します。</p>
            <p>必ず右上の[ 終 了 ]ボタンをクリックして試験を終了し、退出手続きを行ってください。</p>
        </div>
        <div class="cbt_demo_exam-footer">
        </div>
    </div>
</body>
</html>