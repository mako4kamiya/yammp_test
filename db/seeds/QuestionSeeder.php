<?php


use Phinx\Seed\AbstractSeed;

class QuestionSeeder extends AbstractSeed
{
    public function run()
    {
        $sql = "INSERT INTO questions 
        (
            toi, setsumon, allotion, collectAnswer, examName
        ) 
        VALUES
        (
            1,'1a',3.0,'エ','r01a_fe_pm'
        ),
        (
            1, '1b',3.0, 'オ', 'r01a_fe_pm'
        ),
        (
            1, '2', 3.0, 'オ', 'r01a_fe_pm'
        ),
        (
            1, '3', 3.0, 'イ', 'r01a_fe_pm'
        ),
        (
            2, '1a', 2.4, 'オ', 'r01a_fe_pm'
        ),
        (
            2, '1b', 2.4, 'ウ', 'r01a_fe_pm'
        ),
        (
            2, '2c', 2.4, 'ウ', 'r01a_fe_pm'
        ),
        (
            2, '2d', 2.4, 'イ', 'r01a_fe_pm'
        ),
        (
            2, '3e', 2.4, 'エ', 'r01a_fe_pm'
        ),
        (
            3, '1a', 2.4, 'エ', 'r01a_fe_pm'
        ),
        (
            3, '1b', 2.4, 'イ', 'r01a_fe_pm'
        ),
        (
            3, '2c', 2.4, 'イ', 'r01a_fe_pm'
        ),
        (
            3, '3d', 2.4, 'ア', 'r01a_fe_pm'
        ),
        (
            3, '3e', 2.4, 'カ', 'r01a_fe_pm'
        ),
        (
            4, '1', 2.4, 'エ', 'r01a_fe_pm'
        ),
        (
            4, '2a', 2.4, 'エ', 'r01a_fe_pm'
        ),
        (
            4, '2b', 2.4, 'ウ', 'r01a_fe_pm'
        ),
        (
            4, '2c', 2.4, 'イ', 'r01a_fe_pm'
        ),
        (
            4, '2d', 2.4, 'カ', 'r01a_fe_pm'
        ),
        (
            5, '1a', 2.0, 'ア', 'r01a_fe_pm'
        ),
        (
            5, '1b', 2.0, 'オ', 'r01a_fe_pm'
        ),
        (
            5, '1c', 2.0, 'ク', 'r01a_fe_pm'
        ),
        (
            5, '1d', 2.0, 'キ', 'r01a_fe_pm'
        ),
        (
            5, '2e', 2.0, 'オ', 'r01a_fe_pm'
        ),
        (
            5, '2f', 2.0, 'ク', 'r01a_fe_pm'
        ),
        (
            6, '1a', 2.0, 'ア', 'r01a_fe_pm'
        ),
        (
            6, '1b', 2.0, 'ア', 'r01a_fe_pm'
        ),
        (
            6, '1c', 2.0, 'エ', 'r01a_fe_pm'
        ),
        (
            6, '2d', 2.0, 'エ', 'r01a_fe_pm'
        ),
        (
            6, '2e', 2.0, 'イ', 'r01a_fe_pm'
        ),
        (
            6, '3f', 2.0, 'イ', 'r01a_fe_pm'
        ),
        (
            7, '1a', 2.4, 'イ', 'r01a_fe_pm'
        ),
        (
            7, '1b', 2.4, 'イ', 'r01a_fe_pm'
        ),
        (
            7, '2c', 2.4, 'ア', 'r01a_fe_pm'
        ),
        (
            7, '3d', 2.4, 'イ', 'r01a_fe_pm'
        ),
        (
            7, '3e', 2.4, 'ウ', 'r01a_fe_pm'
        ),
        (
            8, '1a', 2.2, 'イ', 'r01a_fe_pm'
        ),
        (
            8, '1b', 2.2, 'ア', 'r01a_fe_pm'
        ),
        (
            8, '1c', 2.2, 'ア', 'r01a_fe_pm'
        ),
        (
            8, '2d', 2.2, 'イ', 'r01a_fe_pm'
        ),
        (
            8, '2e', 2.2, 'キ', 'r01a_fe_pm'
        ),
        (
            8, '2f', 2.2, 'カ', 'r01a_fe_pm'
        ),
        (
            8, '3g', 2.2, 'カ', 'r01a_fe_pm'
        ),
        (
            8, '3h', 2.2, 'イ', 'r01a_fe_pm'
        ),
        (
            8, '3i', 2.2, 'ウ', 'r01a_fe_pm'
        ),
        (
            9, '1a', 3.3, 'ア', 'r01a_fe_pm'
        ),
        (
            9, '1b', 3.3, 'イ', 'r01a_fe_pm'
        ),
        (
            9, '1c', 3.3, 'ア', 'r01a_fe_pm'
        ),
        (
            9, '1d', 3.3, 'オ', 'r01a_fe_pm'
        ),
        (
            9, '2e', 3.3, 'オ', 'r01a_fe_pm'
        ),
        (
            9, '2f', 3.3, 'ウ', 'r01a_fe_pm'
        ),
        (
            10, '1a', 3.3, 'エ', 'r01a_fe_pm'
        ),
        (
            10, '1b', 3.3, 'オ', 'r01a_fe_pm'
        ),
        (
            10, '1c', 3.3, 'イ', 'r01a_fe_pm'
        ),
        (
            10, '1d', 3.3, 'イ', 'r01a_fe_pm'
        ),
        (
            10, '2e', 3.3, 'ウ', 'r01a_fe_pm'
        ),
        (
            10, '2f ', 3.3, 'ア', 'r01a_fe_pm'
        ),
        (
            11, '1a ', 3.3, 'イ', 'r01a_fe_pm'
        ),
        (
            11, '1b ', 3.3, 'オ', 'r01a_fe_pm'
        ),
        (
            11, '1c ', 3.3, 'イ', 'r01a_fe_pm'
        ),
        (
            11, '1d ', 3.3, 'オ', 'r01a_fe_pm'
        ),
        (
            11, '1e ', 3.3, 'ウ', 'r01a_fe_pm'
        ),
        (
            11, '2',  3.3, 'オ', 'r01a_fe_pm'
        ),
        (
            12, '1a ', 2.5, 'ア', 'r01a_fe_pm'
        ),
        (
            12, '1b ', 2.5, 'ア', 'r01a_fe_pm'
        ),
        (
            12, '1c ', 2.5, 'イ', 'r01a_fe_pm'
        ),
        (
            12, '2d ', 2.5, 'エ', 'r01a_fe_pm'
        ),
        (
            12, '2e ', 2.5, 'エ', 'r01a_fe_pm'
        ),
        (
            12, '2f ', 2.5, '正解なし', 'r01a_fe_pm'
        ),
        (
            12, '3g ', 2.5, 'オ', 'r01a_fe_pm'
        ),
        (
            12, '3h ', 2.5, 'ウ', 'r01a_fe_pm'
        ),
        (
            13, '1a ', 3.3, 'エ', 'r01a_fe_pm'
        ),
        (
            13, '1b ', 3.3, 'エ', 'r01a_fe_pm'
        ),
        (
            13, '1c', 3.3, 'ウ', 'r01a_fe_pm'
        ),
        (
            13, '2d', 3.3,'キ', 'r01a_fe_pm'
        ),
        (
            13, '2e', 3.3, 'キ', 'r01a_fe_pm'
        ),
        (
            13, '2f', 3.3, 'イ', 'r01a_fe_pm'
        )
        ";
        $this->execute($sql);
    }
}
