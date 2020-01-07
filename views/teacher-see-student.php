<!doctype html>
<html>
<head>
    <title>CPMF - <?= $student->getFirstName() ?> <?= $student->getLastName() ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="/assets/css/teacher-styles.css">
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
            <p><?= $group->getName() ?></p>
            <h2><?= $student->getFirstName() ?> <?= $student->getLastName() ?></h2>
        </div>
        <div id="student-picture">
        </div>
        <div id="stats">
            <p class="stat-name plus">Moyenne Générale</p>
            <p class="stat-value plus"><?= $globalAverage ?> / 20</p>
            <div id="more-stats">
                <div>
                    <p class="stat-name">Dernière connexion</p>
                    <p class="stat-value"><?= $student->getLastConnection() ?></p>
                </div>
                <div>
                    <p class="stat-name">Nombre de connexions</p>
                    <p class="stat-value"><?= $student->getTotalTimeConnected() ?></p>
                </div>
                <div>
                    <p class="stat-name">Temps passé sur le site</p>
                    <p class="stat-value">— h — min</p>
                </div>
            </div>
        </div>
        <div class="difficulty-report">
            <p><span class="difficulty-name">Difficulté Facile</span> <span class="average"><span class="tag">Moyenne</span> <span class="value">17,5</span> / 20</span></p>
            <div>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
            </div>
        </div>
        <div class="difficulty-report">
            <p><span class="difficulty-name">Difficulté Facile</span> <span class="average"><span class="tag">Moyenne</span> <span class="value">17,5</span> / 20</span></p>
            <div>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
            </div>
        </div>
        <div class="difficulty-report">
            <p><span class="difficulty-name">Difficulté Facile</span> <span class="average"><span class="tag">Moyenne</span> <span class="value">17,5</span> / 20</span></p>
            <div>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
                <p><span class="step-name">Nom de l'étape</span><span class="step-average"><span class="value">17,5</span> / 20</span></p>
            </div>
        </div>
        <div id="options">
            <a href="#" id="move"><div>Changer <?= $student->getFirstName() ?> de classe</div></a>
            <a href="#"><div>Retirer <?= $student->getFirstName() ?> de la classe</div></a>
        </div>
    </section>

    <div id="create-class-mask">
        <div id="create-class">
            <h2>Changer <?= $student->getFirstName() ?> de classe</h2>
            <p>Sélectionnez la classe dans laquelle vous souhaitez placer Guillaume.</p><br>
            <form method="post">
                <select name="class">
                    <option value="1">Adapter en PHP</option>
                </select>
                <br>
                <input type="submit" value="Confirmer">
                <a href="#" id="cancel">Annuler</a>
            </form>
        </div>
    </div>
    <footer>
    </footer>
    <script>
        var addButton = document.querySelector("#move");
        addButton.addEventListener("click", function() {
            document.querySelector("#create-class-mask").style.display = "flex";
        });

        var cancelButton = document.querySelector("#cancel");
        cancelButton.addEventListener("click", function() {
            document.querySelector("#create-class-mask").style.display = "none";
        });
    </script>
</body>
</html>