<!doctype html>
<html>
<head>
    <title></title>
    <style type="text/css">
        .button {
            background-color: #4CAF50; /* Green */
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
    <p> <?= $student->getName() ?> </p>
    <p> <?= $class->getName() ?> </p>

    <button id="easy" class="button" onclick="showEasyLesson()"> Exercice facile </button>
    <button id="medium" class="button" onclick="showMediumLesson()"> Exercice intermediaire </button>
    <button id="hard" class="button" onclick="showHardLesson()"> Exercice avancée </button>

    <p id="lesson"> </p>

    <a id="path" href="">Faire l'exercice <a>

    <script type="text/javascript">
        var path = document.getElementById('path');
        var lesson = document.getElementById('lesson');
        var button = document.getElementsByClassName('button');


        function resetButtons()
        {
            for (var i = 0; i < button.length; i++) {
                button[i].style.opacity = 1;
            }
        }

        function showEasyLesson()
        {
            path.setAttribute('href', '/exercice/0');
            resetButtons();
            document.getElementById('easy').style.opacity = 0.3;
            lesson.innerHTML = <?= echo $lessons[0]; ?>;
        }

        function showMediumLesson()
        {
            path.setAttribute('href', '/exercice/1');
            resetButtons();
            document.getElementById('medium').style.opacity = 0.3;
            lesson.innerHTML = <?= echo $lessons[1]; ?>;
        }

        function showHardLesson()
        {
            path.setAttribute('href', '/exercice/2');
            resetButtons();
            document.getElementById('hard').style.opacity = 0.3;
            lesson.innerHTML = <?= echo $lessons[2]; ?>;
        }
    </script>
</body>
</html>