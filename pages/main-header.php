<?php
    session_start();
?>

<div class="main-header">
    <h1 class="link-3">たいとる</h1>
    <div class="user-info">
    <p><?php print($_SESSION['user']['studentNumber']); ?></p>
    <p><?php print($_SESSION['user']['userName']); ?></p>
    <p>******</p>
    </div>
</div>