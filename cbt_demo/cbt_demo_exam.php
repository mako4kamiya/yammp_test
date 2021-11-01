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
            <p><span>試験：プロメトリック認定試験（体験版）</span><span>受験者名： 試験 太郎</span></p>
        </div>
        <div class="cbt_demo_exam-main">
            <ul class="nav navs" role="tablist">
                <li role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#sentaku-1" role="tab" aria-controls="sentaku-1" aria-selected="true">1</a>
                </li>
                <li role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#sentaku-2-7" role="tab" aria-controls="sentaku-2-7" aria-selected="false">2-7</a>
                </li>
                <li role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#sentaku-8" role="tab" aria-controls="sentaku-8" aria-selected="false">8</a>
                </li>
                <li role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#sentaku-9-13" role="tab" aria-controls="sentaku-9-13" aria-selected="false">9-13</a>
                </li>
            </ul>
            <div class="tab-content">
                <?php include("cbt_demo_exam-mondai.php") ?>
            </div>
        </div>
        <div class="cbt_demo_exam-footer">
        </div>
    </div>
</body>
</html>