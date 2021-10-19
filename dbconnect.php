<?php

try {
        if (!$_ENV['CLEARDB_DATABASE_URL']) {
            require 'vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            // var_export($dotenv);
        }
        // var_export(empty($_ENV['DB_CONNECTION']));
        $db = new PDO(
            "{$_ENV['DB_CONNECTION']}:dbname={$_ENV['DB_DATABASE']}; host={$_ENV['DB_HOSTNAME']}; port={$_ENV['DB_PORT']}; charset=utf8", "{$_ENV['DB_USERNAME']}", "{$_ENV['DB_PASSWORD']}"
        );
    } catch (PDOException $e) {
        echo 'DB接続エラー： ' . $e->getMessage();
    }
?>

