<!doctype html>
<html>
<head>
	<title>Mot de passe oublié</title>
</head>
<body>
	<h1>Mot de passe oublié</h1>
	<p>Entrer votre email pour changer votre mot de passe</p>
	<form action="/forgot-password" method="POST">
		<label for="email">Adresse E-mail: </label>
		<input type="email" name="email">
		<input type="submit" value="Envoyer">
	</form>

</body>
</html>