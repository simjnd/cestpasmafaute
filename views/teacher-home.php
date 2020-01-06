<!doctype html>
<html>
<head>
    <title>C'est pas ma faute !</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="assets/css/teacher-styles.css">
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
            <h1>Tableau de Bord</h1>
        </div>
        <a href="/approval">
            <div class="block waiting-student">
                <div><p><?= $numberWaitingStudents ?> élèves en attente de validation</p></div>
            </div>
        </a>
        
        <div class="subsection-title-action">
            <p><h2>Mes classes</h2><a href="#" id="add-class">Ajouter une classe</a></p>
        </div>
        <?php foreach ($classes as $class) { ?>
        <a href="/class/<?= $class->getIdClass() ?>">
            <div class="block class">
                <div><p><?= $class->getName() ?><span><?= count($class->getStudents()) ?> élèves</span></p></div>
            </div>
        </a>
        <?php } ?>
    </section>

    <div id="create-class-mask">
        <div id="create-class">
            <h2>Créer une classe</h2>
            <p>Saisissez les informations de la classe dans le formulaire.</p><br>
            <form method="post">
                <label for="class-name">Nom de la classe</label><br>
                <input type="text" id="class-name" name="class-name"><br>
                <br>

                <p>Niveau de la classe</p>
                <input type="radio" id="seconde" name="class-course">
                <label for="seconde">Seconde</label>

                <input type="radio" id="premiere" name="class-course">
                <label for="premiere">Première</label>

                <input type="radio" id="bts" name="class-course">
                <label for="bts">BTS</label><br><br>

                <input type="submit" value="Confirmer">
                <a href="#" id="cancel-class">Cancel</a>
            </form>
        </div>
    </div>
    <footer>
    </footer>
    <script>
        var addButton = document.querySelector("#add-class");
        addButton.addEventListener("click", function() {
            document.querySelector("#create-class-mask").style.display = "flex";
        });

        var cancelButton = document.querySelector("#cancel-class");
        cancelButton.addEventListener("click", function() {
            document.querySelector("#create-class-mask").style.display = "none";
        });
    </script>
</body>
</html>