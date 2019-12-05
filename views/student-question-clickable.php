<!doctype hmtl>
<html>
<head>
	<title>Question </title>
</head>
<body>
	<h1> <?= $step->getName() ?></h1>
	<p>Question <?= $questionNumber ?></p>
	<p>Cliquer sur la faute ou sur Il n'y pas de faute.</p>
	<p><?= $clickableQuestion->getSentence() ?></p>
	<a href="<?= $nextQuestion ?>">Il n'y a pas de faute</a>
</body>
</html>