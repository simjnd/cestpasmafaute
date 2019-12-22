<!DOCTYPE html>
<html>
	<head>
		<title> Simple Question </title>	
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
			<h3> Saisis le bon mot ! </h3>
			<h2> <?php $simpleQuestion->getFirstHalf(); ?> </h2>
			<input type="text" name="answer"> <!-- Where you input your answer -->
			<h2> <?php $simpleQuestion->getSecondHalf(); ?> </h2>
		</div> 

		<div>
			<input type="submit" name="Question suivante">
		</div>
	</body>
</html>