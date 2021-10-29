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
    <div>
        <div class="cbt_demo_exam-header">
            <div>
                <p>
                </p>
                <p>
                    <span>残り時間</span>
                    <span>00:15:00</span>
                </p>
                <button type="button" class="btn" >終了</button>
            </div>
            <p><span>試験：プロメトリック認定試験（体験版）</span><span>受験者名： 試験 太郎</span></p>
        </div>
        <div class="cbt_demo_exam-main">

            <ul class="nav navs" id="myTab" role="tablist">
                <li role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#toi-1" role="tab" aria-controls="toi-1" aria-selected="true">1</a>
                </li>
                <li role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">2</a>
                </li>
                <li role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">3</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <?php include("cbt_demo_exam-mondai.php") ?>
            </div>
        </div>
        <div class="cbt_demo_exam-footer">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade show cbt_demo_check" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">確認</div>
                <div class="modal-body">
                    <p>採点の対象として選択した問題は次のとおりであるかをご確認ください。</p>
                    <p>選択を変更する場合や回答を続ける場合には「戻る」をクリックしてください。</p>
                    <div>
                        <p>2-5</p>
                        <p>問2</p>
                        <p>問3</p>
                    </div>
                    <div>
                        <p>7-11</p>
                        <p>問7</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" onclick="location.href='./cbt_demo_end.php'">確認</button>
                    <button type="button" class="btn" onclick="location.href='./cbt_demo_exam.php?action=rewrite'">キャンセル</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-backdrop fade show"></div>
</body>
</html>