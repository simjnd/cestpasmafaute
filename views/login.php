<!doctype html>
<html>
	<head>	
		<link rel="stylesheet" href="assets/css/styles.css" />
	</head>
	<body>
		<h1>Connexion</h1>
		<?php if(isset($error)) { ?>
		<p>
			<p>Erreur: <?=$error;?></p>
		</p>
		<?php } ?>
		<form action="/login" method="post">
			<p>
				<label for="email">Adresse E-mail: </label>
				<input type="email" name="email" />
			</p>
			<p>
				<label for="password">Mot de passe: </label>
				<input type="password" name="password" />
			</p>
			<input type="submit" value="Se Connecter" />
		</form>
	</body>
</html>