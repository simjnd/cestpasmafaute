<!doctype html>
<html>
<head>
    <title>CPMF - En attente de validation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="assets/css/teacher-styles.css">
</head>
<body>
    <header>
        <div id="logo">
            <a href="/">
                <picture>
                    <source media="(max-width: 1024px)" srcset="/assets/img/logo-horizontal-small-black.svg">
                    <img src="/assets/img/logo-horizontal-black.svg">
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
            <h2>Élèves en attente de validation</h2>
        </div>
        <?php foreach ($waitingStudents as $waitingStudent) { ?>
        <div class="block waiting-student">
            <div>
                <p><span class="student-name"><?= $waitingStudent->getFirstName() ?> <?= $waitingStudent->getLastName() ?></span><span class="buttons"><a href="/approval/accept/<?= $waitingStudent->getIdLogin() ?>">Accepter</a> <a href="/approval/delete/<?= $waitingStudent->getIdLogin() ?>">Refuser</a></span></p>
                <p class="student-email"><?= $waitingStudent->getEmail() ?></p>
            </div>
        </div>
        <?php } ?>
    </section>
    <footer>
    </footer>
</body>
</html>