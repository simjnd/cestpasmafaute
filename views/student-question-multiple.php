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

		<div>
			<h3> Choisis la bonne réponse  </h3>
			<h2> <?php $multipleQuestion->getSentence(); ?> </h2>
		</div> <br>

		<div>
			<?php foreach ($choices as $choice) { ?>
				<p> <input type="radio" name="<?php $choice->getLabel(); ?>"> </p>
			<?php } ?>
		</div>

		<div>
			<input type="submit" name="Question suivante">
		</div>
	</body>
</html>