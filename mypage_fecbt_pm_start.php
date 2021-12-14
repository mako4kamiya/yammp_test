<?php
    require('dbconnect.php');
    session_start();

    if ($_REQUEST['examName'] == "" || empty($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['examName'] = $_REQUEST['examName'];
        $examName = $_SESSION['examName'];
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
    <link rel="stylesheet" href="css/mypage_fecbt_pm.css">
    <title>CBT体験 - デモ </title>
</head>
<body id="mypage_fecbt_pm_start">
    <!-- 問題確認モーダル -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                試験内容の確認
            </div>
            <div class="modal-body">
                <div>
                    <p>（体験版）</p>
                    <p>試験名：<?php print $examName ?> 基本情報技術者試験 午後</p>
                    <p>受験者名：<?php print $_SESSION['user']['userName'] ?></p>
                </div>
                <p>上記の内容が正しければ「確認」を、<br>誤りがあれば「キャンセル」をクリックしてください。</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" onclick="location.href='./mypage_fecbt_pm_info.php'">確認</button>
                <button type="button" class="btn" onclick="location.href='./mypage_fecbt_pm_start.php?examName=<?php print $examName?>'" data-bs-dismiss="modal">キャンセル</button>
            </div>
            </div>
        </div>
    </div>
    
    <header>
        <a href="/"><img src="image/logo_demo.png" alt="logo_demo"></a>
        <p>FE午後問題CBT体験</p>
    </header>
    <main>
        <div>
            <h1>受験者用PC</h1>
            <h2>JPM2-T0001-21</h2>
        </div>
        <div>
            <div>
                <p>試験名：<?php print $_SESSION['examName'] ?> 基本情報技術者試験 午後（体験版）</p>
                <p>受験者名：<?php print $_SESSION['user']['userName'] ?></p>
            </div>
        </div>
        <button type="button" class="btn btn-lg" data-bs-toggle="modal" data-bs-target="#modal">試験開始</button>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>