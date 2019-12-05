<!DOCTYPE html>
<html>
<head>
	<title> Ma classe </title>	
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	<header>
		<h1><?= $class->getName() ?></h1>
        <img src="#profil">
        <p><?= $student->getFirstName() ?> <?= $student->getClass() ?></p>
    </header>
	
    <?php foreach ($classmates as $classmate) { ?>
    <!-- Classmate's icon -->
    <p><?= $classmate->getFirstName() ?> <?= $classmate->getLastName() ?></p>
    <?php } ?>
</body>
</html>