<!doctype html>
<html>
<head>
    <title>Accueil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

    <p><a href="#">Mon profil</a></p>
    <p><a href="#">Ma classe</a></p>

    <!-- Student's avatar -->
    <h1><?= $totalPoints ?> points</h1>
    <progress id="file" max="100" value="<?= $totalPoints % 100 ?>"></progress>

    <?php foreach ($steps as $step) { ?>
    <!-- Step's image -->
    <a href="#"><?= $step->getName() ?></a>
    <?php } ?>
    
    <?php foreach ($endlessModes as $endlessMode) { ?>
    <a href="#"><?= $endlessMode->getName() ?></a>
    <?php } ?>

    <br>
    <br>
    <br>
    
    <h5>Examination</h5>
    <p>Type in your password to participate in an examination</p>
    
    <form action="/examination" method="post">
        <input type="text" name="examination-password">
        <input type="submit" value="Commencer l'examen">
    </form>
    
</body>
</html>