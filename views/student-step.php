<!doctype html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1><?= $step->getName() ?></h1>
	<img src="<?= $avatar ?>">
	<p><?= $class->getName(); ?></p>
	<p><?= $totalPoints ?></p>
	<p><?= $lessons[0] ?></p> 
	<p>Exercice facile</p>
	<p><?= $lessons[1] ?></p>
	<p>Exercice intermediate</p>
	<p><?= $lessons[2] ?></p>
	<p>Exercice expert</p>

	<a href="/exercice/0">Faire l'exercice facile</a>
	<a href="/exercice/1">Faire l'exercice intermediaire</a>
	<a href="/exercice/2">Faire l'exercice difficile</a>
</body>
</html>