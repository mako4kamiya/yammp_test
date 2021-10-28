<?php

use Phinx\Migration\AbstractMigration;

class UsersTable extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE TABLE `users` (
                `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `studentNumber` int(11) NOT NULL UNIQUE,
                `userName` varchar(15) NOT NULL,
                `password` varchar(255) NOT NULL,
                `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
                );"
                ;
        $users = $this->execute($sql);
    }
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS users";
        $this->execute($sql);
    }
}
