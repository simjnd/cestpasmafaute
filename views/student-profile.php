<!doctype html>
<html>
<head>
	<title>Mon profil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
	<h1>Mon profil</h1>
	<img src="<?= $avatar ?>">
	<img src="<?= $avatar ?>">
	<p><a href="/signout">Déconnexion</a></p>
	<p>Nom : <?= $student->getLastName() ?></p>
	<p>Prénom : <?= $student->getFirstName() ?></p>
	<p>email : <?= $student->getEmail() ?></p>
	<p>Classe : <?= $class->getName() ?></p>

	<a href="#">Cadres</a>
	<a href="#">Portraits</a>
	<a href="#">Accessoires</a>

	<div id="Frame">
		<?php foreach ($frames as $frame) { ?>
			<img src="<?= $frame->getFilePath() ?>">
		<?php } ?>
	</div>

	<div id="Portrait">
		<?php foreach ($frames as $frame) { ?>
			<img src="<?= $frame->getFilePath() ?>">
		<?php } ?>
	</div>

	<div id="Accessory">
		<?php foreach ($frames as $frame) { ?>
			<img src="<?= $frame->getFilePath() ?>">
		<?php } ?>
	</div>

	<a href="#">Modifier mot de passe</a>
</body>
</html>