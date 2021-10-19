<?php include("html_head.php"); ?>

<body id="cbt">
<?php include("header.php"); ?>
</body>

<main>

  <!-- 選択されているとき -->
  <div class="card">
    <div class="card-header"></div>
    <p>採点の対象として選択した問題は次のとおりであるかをご確認ください。</p>
    <p>選択を変更する場合や解答を続ける場合には「戻る」をクリックしてください。</p>

    <p>2-5</p>
    <div class="card select-card">
      <p>問2.</p>
      <p>問3.</p>
    </div>
    
    <p>7-11</p>
    <div class="card select-card1">
      <p>問7.</p>
    </div>
    <button type="button" class="btn btn-primary btn-siken">試験を終了する</button>
    <button type="button" class="btn btn-primary btn-siken">戻る</button>
  </div>

  <!-- 選択されていないとき -->
  <div class="card">
    <div class="card-header">確認</div>
    <p>採点の対象とする問題の選択数が足りません。</p>
    <p>指定された数の問題を選択してください。</p>
    <button type="button" class="btn btn-primary">閉じる</button>
  </div>

</main>

</html>