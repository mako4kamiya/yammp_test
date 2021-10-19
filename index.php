<?php
  require('./dbconnect.php');
  $users = $db->query('SELECT * FROM users');
	$questions = $db->query('SELECT * FROM questions');
	$user_answers = $db->query('SELECT * FROM user_answers');
	$seigohyous = $db->query('SELECT * FROM seigohyou');
	$scores = $db->query('SELECT * FROM scores');
	
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>yammp_test</title>
		<style>
			main {
				display: flex;
				flex-wrap: wrap;
				justify-content: space-around;
			}
			table {
				border-collapse: collapse;
				margin-right: 1em;
			}
		</style>
	</head>
	<body>
		<h1>yammp_test</h1>
		<main>

			<section class="users">
				<table border>
					<caption>users</caption>
					<thead>
						<tr scope="row">
							<th>id</th>
							<th>studentNumber</th>
							<th>userName</th>
							<th>password</th>
						</tr>
					</thead>
					<tbody>
					<?php while($user = $users->fetch()): ?>
						<tr>
							<td><?php print($user['id']); ?></td>
							<td><?php print($user['studentNumber']); ?></td>
							<td><?php print($user['userName']); ?></td>
							<td><?php print($user['password']); ?></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</section>

			<section class="questions">
				<table border>
					<caption>questions</caption>
					<thead>
						<tr>
							<th>toi</th>
							<th>setsumon</th>
							<th>allotion</th>
							<th>collectAnswer</th>
							<th>examName</th>
						</tr>
					</thead>
					<tbody>
					<?php while($question = $questions->fetch()): ?>
						<tr>
							<td><?php print($question['toi']); ?></td>
							<td><?php print($question['setsumon']); ?></td>
							<td><?php print($question['allotion']); ?></td>
							<td><?php print($question['collectAnswer']); ?></td>
							<td><?php print($question['examName']); ?></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</section>

			<section class="user_answers">
				<table border>
					<caption>user_answers</caption>
					<thead>
						<tr>
							<th>userID</th>
							<th>questionID</th>
							<th>userAnswer</th>
							<th>selected</th>
							<th>created_at</th>
						</tr>
					</thead>
					<tbody>
					<?php while($user_answer = $user_answers->fetch()): ?>
						<tr>
							<td><?php print($user_answer['userID']); ?></td>
							<td><?php print($user_answer['questionID']); ?></td>
							<td><?php print($user_answer['userAnswer']); ?></td>
							<td><?php print($user_answer['selected']); ?></td>
							<td><?php print($user_answer['created_at']); ?></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</section>

			<section class="seigohyou">
				<table border>
					<caption>seigohyou</caption>
					<thead>
						<tr>
							<th>userID</th>
							<th>questionID</th>
							<th>toi</th>
							<th>setsumon</th>
							<th>collectAnswer</th>
							<th>userAnswer</th>
							<th>getpoint</th>
							<th>selected</th>
							<th>created_at</th>
						</tr>
					</thead>
					<tbody>
					<?php while($seigohyou = $seigohyous->fetch()): ?>
						<tr>
							<td><?php print($seigohyou['userID']); ?></td>
							<td><?php print($seigohyou['questionID']); ?></td>
							<td><?php print($seigohyou['toi']); ?></td>
							<td><?php print($seigohyou['setsumon']); ?></td>
							<td><?php print($seigohyou['collectAnswer']); ?></td>
							<td><?php print($seigohyou['userAnswer']); ?></td>
							<td><?php print($seigohyou['getPoint']); ?></td>
							<td><?php print($seigohyou['selected']); ?></td>
							<td><?php print($seigohyou['created_at']); ?></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</section>

			<section class="scores">
				<table border>
					<caption>scores</caption>
					<thead>
						<tr>
							<th>userID</th>
							<th>questionID</th>
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>
							<th>7</th>
							<th>8</th>
							<th>9</th>
							<th>10</th>
							<th>11</th>
							<th>12</th>
							<th>13</th>
							<th>total</th>
							<th>date</th>
						</tr>
					</thead>
					<tbody>
					<?php while($score = $scores->fetch()): ?>
						<tr>
							<td><?php print($score['userID']); ?></td>
							<td><?php print($score['questionID']); ?></td>
							<td><?php print($score['1']); ?></td>
							<td><?php print($score['2']); ?></td>
							<td><?php print($score['3']); ?></td>
							<td><?php print($score['4']); ?></td>
							<td><?php print($score['5']); ?></td>
							<td><?php print($score['6']); ?></td>
							<td><?php print($score['7']); ?></td>
							<td><?php print($score['8']); ?></td>
							<td><?php print($score['9']); ?></td>
							<td><?php print($score['10']); ?></td>
							<td><?php print($score['11']); ?></td>
							<td><?php print($score['12']); ?></td>
							<td><?php print($score['13']); ?></td>
							<td><?php print($score['total']); ?></td>
							<td><?php print($score['date']); ?></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</section>

		</main>
	</body>
</html>
