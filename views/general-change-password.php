<!doctype html>
<html>
<head>
	<title>Changer le mot de passe</title>
</head>
<body>
	<h1>Changer votre mot de passe</h1>
	<form action="/profile" action="POST">
		<p>
			<label>Mot de passe actuel: </label>
			<input type="password" name="actualPassword">
		</p>
		<p>
			<label>Nouveau mot de passe: </label>
			<input type="password" name="password">
		</p>
		<p>
			<label>Confirmer le mot de passe: </label>
			<input type="password" name="passwordConfirmation">
		</p>
		<p>
			<input type="submit">
		</p>
		<p>
			<a href="/profile"></a>
		</p>
	</form>
</body>
</html>