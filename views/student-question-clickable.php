<!DOCTYPE html>
<html>
	<head>
		<title> Clickable Question </title>	
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/styles.css">
	</head>
	<body>
		<header>
			<img src="#logoDuSite">
			<h2> <?php $step->getName(); ?> </h2>
			<h1> Question n° </h1>
			<img src="#profil">
			<p> <?php $student->getFirstName(); 
				$student->getClass(); ?> 
			</p>
		</header>

		<div id="question">
			<h3> Cliquer sur la faute ou sur "Il n'y a pas de faute". </h3>
			<h2> <?php $clickableQuestion->getSentence(); ?> </h2>
		</div> <br>

		<div id="confirm">
			<input type="submit" name="Il n'y a pas de faute">
		</div>
	</body>
</html>