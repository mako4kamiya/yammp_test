<?php
    session_start();
    if (preg_match('/mypage/', $_SERVER['REQUEST_URI'])) {
        $title = 'My page';
    } elseif (preg_match('/score/', $_SERVER['REQUEST_URI'])) {
        $title = 'SCORE';
    } elseif (preg_match('/delete/', $_SERVER['REQUEST_URI'])) {
        $title = 'EDIT';
    }
?>

<div class="main-header">
    <h1 class="link-3"><?php print($title) ?></h1>
    <div class="user-info">
        <p><?php print($_SESSION['user']['userName']); ?></p>
        <p><?php print($_SESSION['user']['studentNumber']); ?></p>
    <p>******</p>
    </div>
</div>