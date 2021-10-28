<?php

use Phinx\Migration\AbstractMigration;

class AnswersTable extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `answers`(
            `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `userAnswer` VARCHAR(1) NULL DEFAULT NULL,
            `selected` TINYINT(1) NOT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
            `userID` INT(11) NOT NULL,
            `questionID` INT(11) NOT NULL,
            FOREIGN KEY fk_userID(userID) REFERENCES users(id),
            FOREIGN KEY fk_questionID(questionID) REFERENCES questions(id)
            );"
        ;
        $user_answers = $this->execute($sql);
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS answers";
        $this->execute($sql);
    }
}
