<!doctype html>
<html>
<head>
    <title>C'est pas ma faute !</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="assets/css/student-styles.css">
</head>
<body>
    <header>
        <div id="logo">
            <a href="/">
                <picture>
                    <source media="(max-width: 1024px)" srcset="assets/img/logo-horizontal-small.svg">
                    <img src="assets/img/logo-horizontal.svg">
                </picture>
            </a>
        </div>
        <div id="title">
            <p><span><?= $totalPoints ?></span> points</p>
            <progress value="<?= $totalPoints % 100 ?>" max="100"></progress>
        </div>
        <div id="profile">
            <a href="/profile">
                <div></div>
            </a>
        </div>
    </header>
    <section id="content">
        <?php //$tilt = 'tilt-left'; ?>
        <div id="step-choice">
            <?php foreach ($steps as $step) { ?>
                <?php //$tilt = ($tilt === 'tilt-left') ? 'tilt-right' : 'tilt-left'; ?>
                <a href="step/<?= $step->getIdStep() ?>" class="step">
                    <img src="assets/img/step-<?= $step->getImage() ?>">
                </a>
            <?php } ?>
        </div>
        <div id="endless-modes">
            <a href="#" class="easy">
                <div>
                    <p>Mode Sans-Fin Facile</p>
                </div>
            </a>
            <a href="#" class="medium">
                <div>
                    <p>Mode Sans-Fin Moyen</p>
                </div>
            </a>
            <a href="#" class="hard">
                <div>
                    <p>Mode Sans-Fin Difficile</p>
                </div>
            </a>
        </div>
        <div id="register-examination">
            <h3>S'enregistrer pour un Examen</h3>
            <p>Saisissez le code indiqué par votre enseignant pour commencer l'examen.</p>
            <form action="/examination" method="post">
                <input type="text" name="examination-password" placeholder="Code de l'examen">
                <input type="submit" value="Commencer l'examen">
            </form>
        </div>
    </section>
    <footer>
    </footer>
</body>
</html>