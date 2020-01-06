<!doctype html>
<html>
<head>
    <title>Mon profil - C'est pas ma faute</title>
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
            <a href="#">
                <div></div>
            </a>
        </div>
    </header>
    <section id="content">
        <h1>Mon profil</h1>
        <div id="avatar-customization">
            <div id="avatar-big">
            </div>
            <div id="decoration-tab">
                <a href="#" class="show" id="show-accessory">
                    <div><img src="assets/img/icon-accessory.svg"></div>
                </a>
                <a href="#" class="show" id="show-portrait">
                    <div><img src="assets/img/icon-portrait.svg"></div>
                </a>
                <a href="#" class="show" id="show-frame">
                    <div><img src="assets/img/icon-frame.svg"></div>
                </a>
            </div>
            <div class="decoration-selection" id="accessory">
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
            </div>
            <div class="decoration-selection" id="portrait">
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
            </div>
            <div class="decoration-selection" id="frame">
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
                <a href="#">
                    <div></div>
                </a>
            </div>
        </div>
        <h2>Informations</h2>
        <div id="user-information">
            <div>
                <h3>Nom</h3>
                <p><?= $student->getLastName() ?></p>
            </div>
            <div>
                <h3>Prénom</h3>
                <p><?= $student->getFirstName() ?></p>
            </div>
            <div>
                <h3>E-Mail</h3>
                <p><?= $student->getEmail() ?></p>
            </div>
            <div>
                <h3>Classe</h3>
                <p><?= $class->getName() ?></p>
            </div>
        </div>
        <a href="/change-password" id="edit-profile">Modifier mon mot de passe</a>
    </section>
    <footer>
    </footer>
    <script>
        function hideDecorationSelectors() {
            document.querySelectorAll(".decoration-selection").forEach(function(currentValue) {
                currentValue.style.display = "none";
            });
            document.querySelectorAll(".show").forEach(function(currentValue) {
                currentValue.childNodes[1].style.opacity = "";
            })
        }

        var showAccessory = document.querySelector("#show-accessory");
        var showPortrait = document.querySelector("#show-portrait");
        var showFrame = document.querySelector("#show-frame");

        showAccessory.childNodes[1].style.opacity = 1;

        showAccessory.addEventListener("click", function() {
            hideDecorationSelectors();
            document.querySelector("#accessory").style.display = "inline-flex";
            showAccessory.childNodes[1].style.opacity = 1;
        });

        showPortrait.addEventListener("click", function() {
            hideDecorationSelectors();
            document.querySelector("#portrait").style.display = "inline-flex";
            showPortrait.childNodes[1].style.opacity = 1;
        });

        showFrame.addEventListener("click", function() {
            hideDecorationSelectors();
            document.querySelector("#frame").style.display = "inline-flex";
            showFrame.childNodes[1].style.opacity = 1;
        });
    </script>
</body>
</html>