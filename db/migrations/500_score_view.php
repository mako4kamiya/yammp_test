<?php

use Phinx\Migration\AbstractMigration;

class ScoreView extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE VIEW `score` AS
                SELECT
                    `seigohyou`.`toi` AS `toi`,
                    `seigohyou`.`fieldName` AS `fieldName`,
                    SUM(`seigohyou`.`seigo`) / COUNT(0) * 100 AS `rate`,
                    SUM(`seigohyou`.`seigo`) / COUNT(0) * `seigohyou`.`allotion` AS `point`,
                    `seigohyou`.`selected` AS `selected`,
                    `seigohyou`.`examName` AS `examName`,
                    `seigohyou`.`userID` AS `userID`,
                    `seigohyou`.`created_at` AS `created_at`
                FROM
                    `yammp_test`.`seigohyou`
                GROUP BY
                    `seigohyou`.`toi`,
                    `seigohyou`.`examName`,
                    `seigohyou`.`created_at`,
                    `seigohyou`.`userID`
                ORDER BY
                    `seigohyou`.`userID`,
                    `seigohyou`.`created_at`,
                    `seigohyou`.`examName`,
                    `seigohyou`.`toi`;"
                ;
        $users = $this->execute($sql);
    }
    public function down()
    {
        $sql = "DROP VIEW IF EXISTS score";
        $this->execute($sql);
    }
}
