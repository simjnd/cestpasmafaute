<!doctype html>
<html>
	<head>	
		<title>Inscription</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/styles.css">
	</head>
	<body>
		<h1>Connexion</h1>
		<?php if (isset($error)) { ?>
		<p>
			<p>Erreur: <?= $error ?></p>
		</p>
		<?php } ?>
		<a href="/signup">S'inscrire</a>
		<form action="/login" method="post">
			<p>
				<label for="firstName">Prénom: </label>
				<input type="text" name="firstName">
			</p>
			<p>
				<label for="lastName">Nom: </label>
				<input type="text" name="lastName">
			</p>
			<p>
				<label for="email">Adresse E-mail: </label>
				<input type="email" name="email">
			</p>
			<p>
				<label for="password">Mot de passe: </label>
				<input type="password" name="password">
			</p>
			<input type="submit" value="S'inscrire">
		</form>
	</body>
</html>