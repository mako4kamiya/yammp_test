<?php
    session_start();
    if (preg_match('/mypage/', $_SERVER['REQUEST_URI'])) {
        $title = 'My page';;
        $icon = 'mypage-icon';
    } elseif (preg_match('/score/', $_SERVER['REQUEST_URI'])) {
        $title = 'SCORE';
        $icon = 'score-icon';
    } elseif (preg_match('/edit/', $_SERVER['REQUEST_URI'])) {
        $title = 'EDIT';
        $icon = 'edit-icon';
    }
?>

<div class="main-header mypage-menu col-12">
    <h1 class="<?php print($icon) ?>"><?php print($title) ?></h1>
    <div class="user-info">
        <p><?php print($_SESSION['user']['userName']); ?></p>
        <p><?php print($_SESSION['user']['studentNumber']); ?></p>
    <p>******</p>
    </div>
</div>