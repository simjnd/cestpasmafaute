<!DOCTYPE html>
<html>
	<head>
		<title> Puzzle Question </title>	
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

		<div>
			<h3> Deplace les mots dans les cadres correspondant ! </h3>
			<h2> <?php $puzzleQuestion->getSentence(); ?> </h2>
			<!-- Traitement avec start et end marker -->
		</div> 

		<div>
			<input type="submit" name="Question suivante">
		</div>
	</body>
</html>