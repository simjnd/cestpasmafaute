<?php
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!doctype html>
<html>
<head>
    <title></title>
    <style type="text/css">
        .button {
            background-color: #4CAF50; 
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1> <?= $step->getName() ?> </h1>
    <!-- Student's avatar -->
    <h1> <?= $totalPoints ?> points </h1>
    <progress id="file" max="100" value="<?= $totalPoints % 100 ?>"></progress>
    <p> <?= $student->getFirstName() ?> </p>
    <p> <?= $group->getName() ?> </p>

    <button id="easy" class="button" > Exercice facile </button>
    <button id="medium" class="button" > Exercice intermediaire </button>
    <button id="hard" class="button" > Exercice avancé </button>

    <p id="lesson"> </p>

    <a id="path" href=""> <a>

    <script type="text/javascript">
        var path = document.getElementById('path');
        var lesson = document.getElementById('lesson');
        var button = document.getElementsByClassName('button');
        var currentLink = window.location.href;

        for (var i = 0; i < button.length; i++) {
            button[i].addEventListener('click', showLesson);
        }


        function resetButtons()
        {
            for (var i = 0; i < button.length; i++) {
                button[i].style.opacity = 1;
            }
        }

        function showLesson()
        {
            resetButtons();
            let id = this.id;
            switch (id) {
                case 'easy':
                    path.setAttribute('href', currentLink + '/exercice/0');
                    path.innerHTML = "Faire l'exercice facile"
                    lesson.innerHTML = "test";
                    break;
                case 'medium':
                    path.setAttribute('href', currentLink + '/exercice/1');
                    path.innerHTML = "Faire l'exercice intermediaire"
                    lesson.innerHTML = "test2";
                    break;
                case 'hard':
                    path.setAttribute('href', currentLink + '/exercice/2');
                    path.innerHTML = "Faire l'exercice avancé"
                    lesson.innerHTML = "test3";
                    break;
                default:
                    break;
            }
            document.getElementById(id).style.opacity = 0.3;       
        }
    </script>
</body>
</html>