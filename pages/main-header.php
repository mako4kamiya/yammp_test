<?php
    session_start();
    var_export($_SESSION['user']['studentNumber']);
    var_export($_SESSION['user']['userName']);
?>

<div class="main-header">
    <h1 class="link-3">たいとる</h1>
    <div class="user-info">
    <p><?php print($_SESSION['user']['studentNumber']); ?></p>
    <p><?php print($_SESSION['user']['userName']); ?></p>
    <p>******</p>
    </div>
</div>