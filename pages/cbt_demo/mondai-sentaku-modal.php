<?php
  if (glob("cbt_demo/*_fe_pm_qs")) {
    foreach (glob("cbt_demo/*_fe_pm_qs") as $filename) {
      echo $filename. "\n";
    }
  } else {
    echo 'nasi';
  }
?>
<!-- CBT 問題選択 Modal -->
<div class="modal fade" id="mondai-sentaku-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>