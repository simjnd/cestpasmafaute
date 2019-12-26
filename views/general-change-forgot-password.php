<!doctype html>
<html>
<head>
	<title>Changer votre mot de passe</title>
</head>
<body>
	<h1>Changer votre mot de passe</h1>
	<form action="/change-forgot-password/<?= $idLogin ?>/<?= $token ?>" method="POST">
		<p>
			<label for="newPassword">Entrer votre votre nouveau mot de passe</label>
			<input type="password" name="newPassword">
		</p>
		<p>
			<label for="verificationNewPassword">Entrer à nouveau votre nouveau mot de passe</label>
			<input type="password" name="verificationNewPassword">
		</p>	
		<input type="submit" value="Valider">
	</form>
</body>
</html>