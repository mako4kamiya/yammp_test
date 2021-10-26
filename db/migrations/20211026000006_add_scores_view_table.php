<?php

use Phinx\Migration\AbstractMigration;

class AddScoresViewTable extends AbstractMigration
{
    public function up()
    {
        if (!$_ENV['CLEARDB_DATABASE_URL']) {
            require 'vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
            $dotenv->load();
        }

        $sql = "CREATE ALGORITHM=UNDEFINED VIEW `scores`  AS  select `seigohyou`.`userID` AS `userID`,`seigohyou`.`questionID` AS `questionID`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 1) AS `1`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 2) AS `2`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 3) AS `3`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 4) AS `4`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 5) AS `5`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 6) AS `6`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 7) AS `7`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 8) AS `8`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 9) AS `9`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 10) AS `10`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 11) AS `11`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 12) AS `12`,(select `sb`.`getPoint` from (select `seigohyou`.`toi` AS `toi`,sum(`seigohyou`.`getPoint`) AS `getPoint` from `seigohyou` group by `seigohyou`.`toi`) `sb` where `sb`.`toi` = 13) AS `13`,sum(`seigohyou`.`getPoint`) AS `total`,`seigohyou`.`created_at` AS `date` from `seigohyou` group by `seigohyou`.`userID`,`seigohyou`.`created_at`";
        $scores = $this->execute($sql);
    }
    public function down()
    {
        $sql1 = "DROP TABLE IF EXISTS seigohyou";
        $sql2 = "DROP VIEW IF EXISTS scores";
        $this->execute($sql1);
        $this->execute($sql2);
    }
}
