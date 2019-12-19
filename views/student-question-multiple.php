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
			<h1> <?php $question->getQuestionTypeName(); ?> </h1>
			<img src="#profil">
			<p> <?php $student->getFirstName(); 
				$student->getClass(); ?> 
			</p>
		</header>

		<div>
			<h3> <?php $question->getInstruction(); ?> </h3>
			<h2> <?php $question->getSentence(); ?> </h2>
		</div> <br>

		<div>
			<?php foreach ($multipleQuestions as $mQuestion) { ?>
				<p> <?php $mQuestion->getChoices(); ?></p>
			<?php } ?>
		</div>
	</body>
</html>