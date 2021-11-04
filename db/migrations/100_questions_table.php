<?php

use Phinx\Migration\AbstractMigration;

class QuestionsTable extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `questions` (
            `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `collectAnswer` varchar(1) NOT NULL,
            `toi` INT NOT NULL,
            `setsumon` varchar(2) NOT NULL,
            `allotion` double NOT NULL,
            `sentakuGroup` TEXT NOT NULL,
            `sentakushi` INT NOT NULL,
            `fieldName` TEXT NOT NULL,
            `examName` TEXT NOT NULL
            );"
        ;
        $questions = $this->execute($sql);
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS questions";
        $this->execute($sql);
    }
}
