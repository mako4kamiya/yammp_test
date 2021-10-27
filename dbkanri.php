<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CBT体験 - DB管理用</title>
</head>
<body>
    <?php 
        require('dbconnect.php');
        $data_array = [
            [
                'title' => 'TABLES',
                'sql' => 'SHOW TABLES'
            ],
            [
                'title' => 'users',
                'sql' => 'SELECT * FROM `users`'
            ],
            [
                'title' => 'questions',
                'sql' => 'SELECT * FROM `questions`'
            ],
            [
                'title' => 'answers',
                'sql' => 'SELECT * FROM `answers`'
            ],
            [
                'title' => 'seigohyou',
                'sql' => 'SELECT * FROM `seigohyou`'
            ],
            [
                'title' => 'score',
                'sql' => 'SELECT * FROM `score`'
            ],
        ];

    ?>
    <?php foreach($data_array as $data) : ?>
        <?php $statements = $db->query($data['sql']); ?>
        <details>
            <summary><?php print($data['title']) ?></summary>
            <?php while($statement = $statements->fetch()) : ?>
                <pre>
                    <?php print_r($statement) ?>
                </pre>
            <?php endwhile ?>
        </details>
    <?php endforeach ?>


</body>
</html>