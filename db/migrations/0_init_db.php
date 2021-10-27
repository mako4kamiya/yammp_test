<?php

use Phinx\Migration\AbstractMigration;

class InitDb extends AbstractMigration
{
    public function change()
    {
        $questions = "DROP TABLE IF EXISTS questions";
        $this->execute($questions);
        $users = "DROP TABLE IF EXISTS users";
        $this->execute($users);
        $questionsbank = "DROP TABLE IF EXISTS questionsbank";
        $this->execute($questionsbank);
        $user_answers = "DROP TABLE IF EXISTS user_answers";
        $this->execute($user_answers);
        $answers = "DROP TABLE IF EXISTS answers";
        $this->execute($answers);
    }
}
