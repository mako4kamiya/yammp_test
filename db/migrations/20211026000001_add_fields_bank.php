<?php

use Phinx\Migration\AbstractMigration;

class AddFieldsBank extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `fieldsBank` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `fieldName` varchar(15) NOT NULL UNIQUE
                );"
                ;
        $fieldsBank = $this->execute($sql);
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS fieldsBank";
        $this->execute($sql);
    }

}
