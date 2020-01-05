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
		<p> <?php $teacher->getFirstName(); 
		$teacher->getLastName(); ?> 
	</p>
</header>

<div>
	<a href="#attenteValidation"> <?php $numberWaitingStudent ?> en attente de validation </a>
</div> <br>

<table>
	<tr>Mes classes </tr>
	<div> Ajouter </div>
	<?php foreach ($classes as $class) { ?>
		<tr>
			<p>
				<?= $class->getName() ?>
			</p>
			<p>
				<?= count($class->getStudents()) ?>
			</p>
			<a href="modifierClasse"></a>
		</tr>
	<?php } ?>
</table>
</body>
</html>