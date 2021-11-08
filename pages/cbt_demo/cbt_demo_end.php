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
                <button type="button" class="btn" onclick="location.href='/'">終了</button>
            </div>
            <p><span>試験：プロメトリック認定試験（体験版）</span><span>受験者名： 試験 太郎</span></p>
        </div>
        <div class="cbt_demo_end-main">
        <?php 
                    print("<pre>check<br>");
                    var_export($check);
                    print("</pre>");
                    print("<pre>error<br>");
                    var_export($error);
                    print("</pre>");
                    print("<pre>SESSION[answers]<br>");
                    var_export($_SESSION['answers']);
                    print("</pre>");
                    print("<pre>POST<br>");
                    var_export($_POST);
                    print("</pre>");
                ?>

            <p>お疲れ様でした。この試験を終了します。</p>
            <p>必ず右上の[ 終 了 ]ボタンをクリックして試験を終了し、退出手続きを行ってください。</p>
        </div>
        <div class="cbt_demo_exam-footer">
        </div>
    </div>
</body>
</html>