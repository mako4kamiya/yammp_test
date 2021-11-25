<?php
    require('./dbconnect.php');
    session_start();


    if (isset($_SESSION['user'])) {
        // ログイン情報があればマイページ画面を表示する。
        header('Location: mypage.php');
        exit();
    } else if ($_COOKIE["user"]){
        // Cookieにユーザー情報があれば、自動でログイン処理を行って、マイページ画面を表示する。
        $statement = $db->prepare('SELECT * FROM users');
        $statement->execute();
        while ($user = $statement->fetch()) {
            if (password_verify($user['id'], $_COOKIE['user'])) {
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['studentNumber'] = $user['studentNumber'];
                $_SESSION['user']['userName'] = $user['userName'];
                header('Location: mypage.php');
                exit();
            }
        }
    } else {
        header('Location: login.php');
        exit();
    }
?>