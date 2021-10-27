<?php


use Phinx\Seed\AbstractSeed;

class UserAnswerSeeder extends AbstractSeed
{
    public function run()
    {
        $sql = "INSERT INTO user_answers(
            userAnswer,selected,created_at,userID,questionID
            )VALUES
            ('エ',1,NOW(),1,1),
            ('オ',1,NOW(),1,2),
            ('オ',1,NOW(),1,3),
            ('ア',1,NOW(),1,4),
            ('オ',1,NOW(),1,5),
            ('ウ',1,NOW(),1,6),
            ('ウ',1,NOW(),1,7),
            ('イ',1,NOW(),1,8),
            ('ア',1,NOW(),1,9),
            ('エ',1,NOW(),1,10),
            ('イ',1,NOW(),1,11),
            ('イ',1,NOW(),1,12),
            ('ア',1,NOW(),1,13),
            ('ア',1,NOW(),1,14),
            ('エ',1,NOW(),1,15),
            ('エ',1,NOW(),1,16),
            ('ウ',1,NOW(),1,17),
            ('イ',1,NOW(),1,18),
            ('ア',1,NOW(),1,19),
            ('ア',1,NOW(),1,20),
            ('オ',1,NOW(),1,21),
            ('ク',1,NOW(),1,22),
            ('キ',1,NOW(),1,23),
            ('オ',1,NOW(),1,24),
            ('ア',1,NOW(),1,25),
            ('ア',0,NOW(),1,26),
            ('ア',0,NOW(),1,27),
            ('エ',0,NOW(),1,28),
            ('エ',0,NOW(),1,29),
            ('イ',0,NOW(),1,30),
            ('イ',0,NOW(),1,31),
            ('',0,NOW(),1,32),
            ('',0,NOW(),1,33),
            ('',0,NOW(),1,34),
            ('',0,NOW(),1,35),
            ('',0,NOW(),1,36),
            ('イ',1,NOW(),1,37),
            ('ア',1,NOW(),1,38),
            ('ア',1,NOW(),1,39),
            ('イ',1,NOW(),1,40),
            ('キ',1,NOW(),1,41),
            ('カ',1,NOW(),1,42),
            ('カ',1,NOW(),1,43),
            ('イ',1,NOW(),1,44),
            ('ア',1,NOW(),1,45),
            ('ア',1,NOW(),1,46),
            ('イ',1,NOW(),1,47),
            ('ア',1,NOW(),1,48),
            ('オ',1,NOW(),1,49),
            ('オ',1,NOW(),1,50),
            ('ア',1,NOW(),1,51),
            ('',0,NOW(),1,52),
            ('',0,NOW(),1,53),
            ('',0,NOW(),1,54),
            ('',0,NOW(),1,55),
            ('',0,NOW(),1,56),
            ('',0,NOW(),1,57),
            ('イ',0,NOW(),1,58),
            ('オ',0,NOW(),1,59),
            ('イ',0,NOW(),1,60),
            ('オ',0,NOW(),1,61),
            ('ウ',0,NOW(),1,62),
            ('オ',0,NOW(),1,63),
            ('',0,NOW(),1,64),
            ('',0,NOW(),1,65),
            ('',0,NOW(),1,66),
            ('',0,NOW(),1,67),
            ('',0,NOW(),1,68),
            ('',0,NOW(),1,69),
            ('',0,NOW(),1,70),
            ('',0,NOW(),1,71),
            ('',0,NOW(),1,72),
            ('',0,NOW(),1,73),
            ('',0,NOW(),1,74),
            ('',0,NOW(),1,75),
            ('',0,NOW(),1,76),
            ('',0,NOW(),1,77)";
        $this->execute($sql);
    }
}
