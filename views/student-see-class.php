<!doctype html>
<html>
<head>
	<title> Ma classe </title>	
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	<header>
		<h1><?= $group->getName() ?></h1>
        <img src="#profil">
        <p><?= $student->getFirstName() ?> (<?= $group->getName() ?>)</p>
    </header>
	
    <?php foreach ($group->getStudents() as $student) { ?>
    <!-- Classmate's icon -->
    <p><?= $student->getFirstName() ?> <?= $student->getLastName() ?></p>
    <?php } ?>
</body>
</html>