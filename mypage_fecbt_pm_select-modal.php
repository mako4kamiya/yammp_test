<?php
  $exams = [];
  foreach (glob("mypage_fecbt_pm/*_fe_pm_qs/data.json") as $path) {
    $json = file_get_contents($path);
    $data = json_decode($json,true);
    // var_export($data);
    array_push($exams, $data);
  }
?>
<!-- CBT 問題選択 Modal -->
<div class="modal fade" id="mondai-sentaku-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">問題を選択してください</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-betwee">
        <?php foreach($exams as $exam): ?>
          <?php $linkPath = 'mypage_fecbt_pm_start.php?examName=' . $exam['examName']?>
          <button type="button" class="btn btn-light col-6 m-1" onclick="document.location='<?php print $linkPath ?>'"><?php print $exam['examName']?></button>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>