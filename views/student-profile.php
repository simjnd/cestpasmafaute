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

	<p>Nom : <?= $Name ?></p>
	<p>Prénom : <?= $firstName ?></p>
	<p>email : <?= $email ?></p>
	<p>Classe : <?= $class ?></p>

	<?php foreach ($posssibilities as $possibility): ?>
		<div>Resultat</div>
	<?php endforeach ?>

	<a href="#">Modifier mot de passe</a>
</body>
</html>