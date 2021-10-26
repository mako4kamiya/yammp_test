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
        $sql = "CREATE ALGORITHM=UNDEFINED VIEW `seigohyou`  AS  select `user_answers`.`userID` AS `userID`,`user_answers`.`questionID` AS `questionID`,`questionsBank`.`toi` AS `toi`,`questionsBank`.`setsumon` AS `setsumon`,`questionsBank`.`collectAnswer` AS `collectAnswer`,`user_answers`.`userAnswer` AS `userAnswer`,case when `questionsBank`.`collectAnswer` = `user_answers`.`userAnswer` then `questionsBank`.`allotion` else 0 end AS `getPoint`,`user_answers`.`selected` AS `selected`,`user_answers`.`created_at` AS `created_at` from ((`user_answers` join `users` on(`user_answers`.`userID` = `users`.`id`)) join `questionsBank` on(`user_answers`.`questionID` = `questionsBank`.`id`)) order by `user_answers`.`created_at`,`questionsBank`.`id`";
        $seigohyou = $this->execute($sql);
    }
    public function down()
    {
        $sql1 = "DROP TABLE IF EXISTS user_answers";
        $sql2 = "DROP TABLE IF EXISTS questionsBank";
        $sql3 = "DROP VIEW IF EXISTS seigohyou";
        $this->execute($sql1);
        $this->execute($sql2);
        $this->execute($sql3);
    }
}
