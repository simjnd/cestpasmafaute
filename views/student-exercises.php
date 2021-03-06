<!doctype html>
<html>
<head>
	<title>Exercice CPMF</title>
	<meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/student-styles.css">
    <link rel="stylesheet" href="assets/css/green-scheme.css">
</head>
<body>
	<header>
        <div id="logo">
            <a href="#">
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
        <p id="step-name">Nom de l'étape</p>
        <h1 id="question-number">Question <span class="id-question"></span></h1>
        <div id="question">
        	<p>Explication sur comment répondre à ce type de question</p>
            <div id="question-content">
            	<p class="sentence"></p>
            </div>
            <div class="answer">
                <p>Valider</p>
            </div>
        </div>
    </section>
	<footer>
	</footer>
</body>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/exercises.js"></script>
</html>