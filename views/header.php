<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/calendar.css">
	<meta charset="utf-8">
	<title><?= isset($title) ? h($title) : 'Mon Calendrier'; ?></title>
</head>
<body>
	<nav class="navbar navbar-dark bg-primary mb-3">
		<a href="index.php" class="navbar-brand">Mon calendrier</a>
	</nav>