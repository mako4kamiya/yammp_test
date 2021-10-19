<?php

use Phinx\Migration\AbstractMigration;

class AddQuestionsTable extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `questions` (
            `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            `toi` int(1) NOT NULL,
            `setsumon` varchar(2) NOT NULL,
            `allotion` double NOT NULL DEFAULT 0,
            `collectAnswer` varchar(1) NOT NULL,
            `examName` varchar(11) NOT NULL
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
