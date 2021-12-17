<div id="flash" class="container" style="min-height: 50px">
  <?php if(isset($_SESSION['flash'])): ?>
    <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true" style="max-width: 100%; width: 100%">
      <div class="d-flex justify-content-between align-items-center">
        <div class="toast-body">
          <?php print $_SESSION['flash'] ?>
      </div>
        <button type="button" class="btn-close mr-2" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  <?php endif ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="js/flash.js"></script>