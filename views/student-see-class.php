<!DOCTYPE html>
<html>
	<head>
		<title> Ma classe </title>	
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/css/styles.css">
	</head>
	<body>
		<header>
			<img src="#logoDuSite">
			<a href="#./"> </a>
			<h1> Ma classe </h1>
			<img src="#profil">
			<p> <?php $student->getFirstName(); 
				$student->getClass(); ?> 
			</p>
		</header>

		
		<?php foreach($class->getStudents() as $student){ ?>
			<p>
				<?php $student->getIcon(); ?>
			</p>
			<p>
				<?php $student->getLastName(); ?>
			</p>
				
			<p>
				<?php $student->getFirstName(); ?>
			</p>
			
		<?php } ?>
	</body>
</html>