<?php
    require('dbconnect.php');
    session_start();

    if (empty($_SESSION['examName']) || empty($_SESSION['user'])) {
        header("Location: login.php");
        exit();
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
    <div style="display: none" ></div>
    <div>
        <div class="mypage_fecbt_pm_exam-header">
            <div>
                <div></div>
                <div></div>
                <div>
                    <button type="button" class="btn" disabled>終了</button>
                </div>
            </div>
            <p><span>試験：<?php print $examName ?> 基本情報技術者試験 午後（体験版）</span><span>受験者名： <?php print($_SESSION['user']['userName']); ?></span></p>
        </div>

        <div class="mypage_fecbt_pm_exam-main">
            <div class="mypage_fecbt_pm_exam-info">
                <h2>FE午後問題CBT体験</h2>
                <div class="notes-highlight">
                    <p><strong>ハイライト機能</strong></p>
                    <p>実際の試験のようにハイライト機能が使用できます。この機能は、選択肢の絞り込みなどに活用できます。</p>
                    <ol>
                        <li>
                            テキストをマウスでドラックすると、マーカーアイコンが表示されます。
                            <img src="image/highlight1.png">
                        </li>
                        <li>
                            マーカーアイコンをクリックすると、テキストがハイライトされます。
                            <img src="image/highlight2.png">
                        </li>
                        <li>
                            ハイライトされたテキストにカーソルを合わせると、指のアイコンが表示されます。
                            <img src="image/highlight3.png">
                        </li>
                        <li>
                            指のアイコンをクリックすると、ハイライトが削除されます。
                            <img src="image/highlight4.png">
                        </li>
                    </ol>
                </div>
                <div class="notes">
                    <p><strong>注意事項</strong></p>
                    <ul>
                        <li>ここから先の画面では、ブラウザの「戻る」「進む」「更新」ボタンを使用しないでください。</li>
                        <li>本アプリは、実際の試験を想定して作成されていますが、細かい機能やデザインは実際の試験とは異なります。</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mypage_fecbt_pm_exam-footer">
            <button type="button" class="btn" onclick="location.href='./mypage_fecbt_pm_exam.php'">開始</button>
        </div>
    </div>
</body>
</html>