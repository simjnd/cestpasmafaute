<!doctype html>
<html>
<head>
	<title> Tableau de bord </title>	
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	<header>
		<img src="#logoDuSite">
		<h1> Tableau de bord </h1>
		<img src="#profil">
		<p><?= $teacher->getFirstName().' '.$teacher->getLastName() ?></p> 
	</header>

	<div>
		<a href="/approval"> <?php $numberWaitingStudent ?> élèves en attente de validation </a>
	</div> <br>

	<h1>Mes classes</h1>
	<table>
		<?php foreach ($classes as $class) { ?>
			<tr>
				<td><a href="/class/<?= $class->getIdClass() ?>"><?= $class->getName() ?></a></td>
				<td><?= count($class->getStudents()) ?> élèves</td>
				<td><a href="/class/<?= $class->getIdClass() ?>/edit">Modifier</a></td>
			</tr>
		<?php } ?>
	</table>
</body>
</html>