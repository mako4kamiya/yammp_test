<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="mypage_fecbt_pm.css">
    <title>CBT体験 - デモ </title>
</head>
<body id="mypage_fecbt_pm_exam">
    <?php 
        print("<pre>error<br>");
        var_export($error);
        print("</pre>");
        print("<pre>SESSION[answers]<br>");
        var_export($_SESSION['answers']);
        print("</pre>");
        // print("<pre>POST<br>");
        // var_export($_POST);
        // print("</pre>");
    ?>

    <!-- Modal 選択されている場合 -->
    <div class="modal fade show mypage_fecbt_pm_check" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                    <button type="button" class="btn" onclick="location.href='./mypage_fecbt_pm_end.php'">試験を終了する</button>
                    <button type="button" class="btn" onclick="location.href='./mypage_fecbt_pm_exam.php?action=rewrite'">戻る</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 選択が足りない場合 -->
    <!-- <div class="modal fade show mypage_fecbt_pm_check"  tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">確認</div>
                <div class="modal-body">
                    <?php var_export($_SESSION['answers']); ?>
                    <?php var_export($_POST['1']); ?>
                    <p>採点の対象とする問題の選択数が足りません。</p>
                    <p>指定された数の問題を選択してください。</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn not-checked" onclick="location.href='./mypage_fecbt_pm_exam.php?action=rewrite'">閉じる</button>
                </div>
            </div>
        </div>
    </div> -->

    <div class="modal-backdrop fade show"></div>
</body>
</html>