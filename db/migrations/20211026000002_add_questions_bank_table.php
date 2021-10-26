<?php

use Phinx\Migration\AbstractMigration;

class AddQuestionsBankTable extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `questionsBank` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `collectAnswer` varchar(1) NOT NULL,
            `toi` INT NOT NULL,
            `setsumon` varchar(2) NOT NULL,
            `allotion` double NOT NULL,
            `fieldName` TEXT NOT NULL,
            `examName` varchar(11) NOT NULL,
            );"
        ;
        $questions = $this->execute($sql);
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS questionsBank";
        $this->execute($sql);
    }
}
