<?php

function getoffset() {
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	return ($page - 1) * 2;
}

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'creyna', 'chris');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_POST){
//protect against sql injection
$query1= $dbc->prepare("INSERT INTO fav_teams (name, location, sport) VALUES (:name, :location, :sport)");
//always bind values to prevent SQL injection

$query1->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
$query1->bindValue(':location', $_POST['location'], PDO::PARAM_STR);
$query1->bindValue(':sport', $_POST['sport'], PDO::PARAM_STR);
$query1->execute();

}

$query = 'SELECT * FROM fav_teams LIMIT 2 OFFSET ' . getoffset();

$teams = $dbc->query($query)->fetchAll(PDO::FETCH_ASSOC);

$count = $dbc->query('SELECT count(*) FROM fav_teams')->fetchColumn();

//pagination
$numPages = ceil($count/4);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$nextPage = $page + 1;
$prevPage = $page - 1;

?>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SPORTS</title>
	<link src="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<table  class="table table-bordered">
			<?php foreach ($teams as $team): ?>
				<tr>
					<td><?= $team['name']; ?></td>
					<td><?= $team['location']; ?></td>
					<td><?= $team['sport']; ?></td>
				</tr>
			<?php endforeach ?> 
		</table>
	</div>
	<div class="container">
		<form method='POST' action='/sports.php' class="form-horizontal" role="form">
			<input type='text' id='name' name='name' placeholder='name'>
			<input type='text' id='location' name='location' placeholder='location'>
			<input type='text' id='sport' name='sport' placeholder='sport'>
			<input type='submit' id=''>
		</form>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type='text/javascript' src="/js/jquery.min.js"></script>
	<script type='text/javascript' src="/js/bootstrap.min.js"></script>
</body>
<footer>
	<ul>
		<li>
			<a href="?page= <?= $prevPage; ?>">Previous</a>
		</li>
		<li>
			<a href="?page= <?= $nextPage; ?>">NEXT</a>
		</li>
	</ul>
</footer>
</html>