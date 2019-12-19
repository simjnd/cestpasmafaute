<!doctype html>
<html>
	<head>	
		<title>Connexion</title>
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
		<h2>J'ai un compte</h2>
		<form action="/signin" method="post">
			<p>
				<label for="email">Adresse E-mail: </label>
				<input type="email" name="email">
			</p>
			<p>
				<label for="password">Mot de passe: </label>
				<input type="password" name="password">
				<a href="#">Mot de passe oublié</a>
			</p>
			<input type="submit" value="Se Connecter">
		</form>
	</body>
</html>