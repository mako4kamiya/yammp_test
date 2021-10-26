<?php

use Phinx\Migration\AbstractMigration;

class AddQuestionsBankTable extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `questionsBank` (
            `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `field_id` int NOT NULL,
            `toi` int NOT NULL,
            `setsumon` varchar(2) NOT NULL,
            `allotion` double NOT NULL DEFAULT 0,
            `collectAnswer` varchar(1) NOT NULL,
            `examName` varchar(11) NOT NULL,
            FOREIGN KEY fk_field_id(field_id) REFERENCES fieldsBank(id)
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
