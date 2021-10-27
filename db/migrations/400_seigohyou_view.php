<?php

use Phinx\Migration\AbstractMigration;

class SeigohyouView extends AbstractMigration
{
    public function up()
    {
        $sql = "CREATE VIEW `seigohyou` AS
                SELECT
                    `answers`.`id` AS `answers.id`,
                    `questions`.`toi` AS `toi`,
                    `questions`.`setsumon` AS `setsumon`,
                    `questions`.`collectAnswer` AS `collectAnswer`,
                    `answers`.`userAnswer` AS `userAnswer`,
                    CASE WHEN
                        `questions`.`collectAnswer` = `answers`.`userAnswer`
                        THEN 1 ELSE 0
                    END AS `seigo`,
                    `answers`.`selected` AS `selected`,
                    `questions`.`allotion` AS `allotion`,
                    `questions`.`fieldName` AS `fieldName`,
                    `questions`.`examName` AS `examName`,
                    `answers`.`userID` AS `userID`,
                    `answers`.`created_at` AS `created_at`
                FROM
                    (
                        `answers`
                    JOIN `questions` ON
                        (
                            `answers`.`questionID` = `questions`.`id`
                        )
                    )
        ;"
        ;
        $users = $this->execute($sql);
    }
    public function down()
    {
        $sql = "DROP VIEW IF EXISTS seigohyou";
        $this->execute($sql);
    }
}
