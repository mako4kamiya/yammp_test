<?php

use Phinx\Migration\AbstractMigration;

class AddSeigohyouViewTable extends AbstractMigration
{
    public function up()
    {
        if (!$_ENV['CLEARDB_DATABASE_URL']) {
            require 'vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../..');
            $dotenv->load();
        }
        $sql = "CREATE ALGORITHM=UNDEFINED VIEW `seigohyou`  AS  select `user_answers`.`userID` AS `userID`,`user_answers`.`questionID` AS `questionID`,`questions`.`toi` AS `toi`,`questions`.`setsumon` AS `setsumon`,`questions`.`collectAnswer` AS `collectAnswer`,`user_answers`.`userAnswer` AS `userAnswer`,case when `questions`.`collectAnswer` = `user_answers`.`userAnswer` then `questions`.`allotion` else 0 end AS `getPoint`,`user_answers`.`selected` AS `selected`,`user_answers`.`created_at` AS `created_at` from ((`user_answers` join `users` on(`user_answers`.`userID` = `users`.`id`)) join `questions` on(`user_answers`.`questionID` = `questions`.`id`)) order by `user_answers`.`created_at`,`questions`.`id`";
        $seigohyou = $this->execute($sql);
    }
    public function down()
    {
        $sql1 = "DROP TABLE IF EXISTS user_answers";
        $sql2 = "DROP TABLE IF EXISTS questions";
        $sql3 = "DROP VIEW IF EXISTS seigohyou";
        $this->execute($sql1);
        $this->execute($sql2);
        $this->execute($sql3);
    }
}
