<?php

use Phinx\Migration\AbstractMigration;

class AddUserAnswersTable extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `user_answers` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `userID` int(11) NOT NULL,
            `questionID` int(11) NOT NULL,
            `userAnswer` varchar(1) NOT NULL,
            `selected` tinyint(1) NOT NULL DEFAULT 0,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            INDEX userID (userID),
            INDEX questionID (questionID)
            );"
        ;
        $user_answers = $this->execute($sql);
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS user_answers";
        $this->execute($sql);
    }
}
