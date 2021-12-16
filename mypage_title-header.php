<?php
    session_start();
    if (preg_match('/score/', $_SERVER['REQUEST_URI'])) {
        $title = 'SCORE';
        $icon = 'score-icon';
    } elseif (preg_match('/edit/', $_SERVER['REQUEST_URI'])) {
        $title = 'EDIT';
        $icon = 'edit-icon';
    } else {
        $title = 'My page';
        $icon = 'mypage-icon';
    }
?>

<div class="mypage_title-header mypage-menu col-12">
    <h1 class="<?php print($icon) ?>"><?php print($title) ?></h1>
    <div class="user-info">
        <p><?php print($_SESSION['user']['userName']); ?></p>
        <p><?php print($_SESSION['user']['studentNumber']); ?></p>
        <p>******</p>
    </div>
</div>