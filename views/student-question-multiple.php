<!DOCTYPE html>
<html>
	<head>
		<title> Multiple Question </title>	
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
			<h3> Séléctionner le mot qui correspond au trou de la phrase.  </h3>
			<h2> <?php $multipleQuestion->getSentence(); ?> </h2>
		</div> <br>

		<div id="answers">
			<?php foreach ($choices as $choice) { ?>
				<p> <input type="radio" name="<?php $choice->getLabel(); ?>"> </p>
			<?php } ?>
		</div>

		<div id="confirm">
			<input type="submit" name="Valider">
		</div>
	</body>
</html>