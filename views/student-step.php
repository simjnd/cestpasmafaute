<!doctype html>
<html>
<head>
    <title>CPMF - <?= $step->getName() ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="/assets/css/student-styles.css">
    <link rel="stylesheet" href="/assets/css/<?= $step->getColor() ?>-scheme.css">
</head>
<body>
    <header>
        <div id="logo">
            <a href="/">
                <picture>
                    <source media="(max-width: 1024px)" srcset="/assets/img/logo-horizontal-small.svg">
                    <img src="/assets/img/logo-horizontal.svg">
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
        <img src="/assets/img/step-<?= $step->getImage() ?>">
        <div id="step-tabs">
            <div id="show-easy" class="active">
                Facile
            </div>
            <div id="show-medium">
                Moyen
            </div>
            <div id="show-hard">
                Difficile
            </div>
        </div>
        <div class="lesson" id="easy">
            <div class="lesson-content">
                <?= json_encode($lessons[0], JSON_HEX_TAG) ?>
            </div>
            <a href="<?= $_SERVER['REQUEST_URI']?>/exercise/0">
                <div class="start-exercise">
                    Commencer l'exercice facile
                </div>
            </a>
        </div>
        <div class="lesson" id="medium">
            <div class="lesson-content">
                <?= json_encode($lessons[1], JSON_HEX_TAG) ?>
            </div>
            <a href="<?= $_SERVER['REQUEST_URI']?>/exercise/1">
                <div class="start-exercise">
                    Commencer l'exercice moyen
                </div>
            </a>
        </div>
        <div class="lesson" id="hard">
            <div class="lesson-content">
                <?= json_encode($lessons[2], JSON_HEX_TAG) ?>
            </div>
            <a href="<?= $_SERVER['REQUEST_URI']?>/exercise/2">
                <div class="start-exercise">
                    Commencer l'exercice difficile
                </div>
            </a>
        </div>
    </section>
    <footer>
    </footer>
    <script>
        function hideLessons() {
            document.querySelectorAll(".lesson").forEach(function(currentValue) {
                currentValue.style.display = "none";
            });
            showEasy.classList.remove("active");
            showMedium.classList.remove("active");
            showHard.classList.remove("active");
        }

        document.querySelector("#medium").style.display = "none";
        document.querySelector("#hard").style.display = "none";

        var showEasy = document.querySelector("#show-easy");
        var showMedium = document.querySelector("#show-medium");
        var showHard = document.querySelector("#show-hard");

        showEasy.addEventListener("click", function() {
            hideLessons();
            document.querySelector("#easy").style.display = "";
            showEasy.classList.add("active");
        });

        showMedium.addEventListener("click", function() {
            hideLessons();
            document.querySelector("#medium").style.display = "";
            showMedium.classList.add("active");
        });

        showHard.addEventListener("click", function() {
            hideLessons();
            document.querySelector("#hard").style.display = "";
            showHard.classList.add("active");
        });
    </script>
</body>
</html>