<!doctype html>
<html>
<head>
    <title>CPMF - <?= $class->getName() ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="/assets/css/teacher-styles.css">
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
        </div>
        <div id="profile">
        </div>
    </header>
    <section id="content">
        <div class="subsection-title">
            <h2><?= $class->getName() ?></h2>
        </div>
        <div id="exams">
            <?php foreach($examinations as $examination) { ?>
            <div>
                <h3><?= $examination->getName() ?></h3>
                <p><?= $examination->getPassword() ?></p>
            </div>
            <?php } ?>
        </div>
        <?php foreach ($students as $student) { ?>
        <a href="/profile/<?= $student->getIdLogin() ?>">
            <div class="block waiting-student">
                <div>
                    <p><span class="student-name"><?= $student->getFirstName() ?> <?= $student->getLastName() ?></span></p>
                    <p class="student-email"><?= $student->getEmail() ?></p>
                </div>
            </div>
        </a>
        <?php } ?>
        <div id="options">
            <a href="#"><div>Modifier la classe</div></a>
            <a href="#"><div>Supprimer cette classe</div></a>
        </div>
    </section>
    <footer>
    </footer>
</body>
</html>