<?php
    require('./dbconnect.php');
    session_start();

    if ($_COOKIE["user"]){
        $statement = $db->prepare('SELECT * FROM users');
        $statement->execute();
        while ($user = $statement->fetch()) {
            if (password_verify($user['id'], $_COOKIE['yammp_test'])) {
                $_SESSION['user']['studentNumber'] = $user['studentNumber'];
                $_SESSION['user']['userName'] = $user['userName'];
                header('Location: mypage.php');
                exit();
            }
        }
    } else {
        header('Location: pages/login.php');
        exit();
    }
?>