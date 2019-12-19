<!DOCTYPE html>
<html>
<head>
	<title>Étudiants en attente de validation</title>
</head>
<body>
	<h1>En attente de validation</h1>
	<img src="#" alt="logo">

	<p>
		Prof : <?= $teacher->getFirstName() . ' ' . $teacher->getLastName() ?>
	</p>
	<?php foreach ($waitingStudents as $waitingStudent) { ?>
		<p>
			<?= $waitingStudent->getFirstName() . ' ' . $waitingStudent->getLastName() ?><br>
			<?= $waitingStudent->getEmail() ?>
			<a href="#">Valider</a>	<a href="#">Supprimer</a>
		</p>
	<?php } ?>

</body>
</html>