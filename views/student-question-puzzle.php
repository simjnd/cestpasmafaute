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

		<div id="question">
			<h3> Faire glisser les étiquettes décrivant le segment de la phrase correspondant. </h3>
			<h2> <?php $puzzleQuestion->getSentence(); ?> </h2>
			<!-- Traitement avec start et end marker -->
		</div> 

		<div id="confirm">
			<input type="submit" name="Valider">
		</div>
	</body>
</html>