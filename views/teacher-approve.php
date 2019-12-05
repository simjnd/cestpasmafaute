<!doctype html>
<html>
    <head>  
        <title>C'est pas ma faute</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <h1>En attente de validation</h1>
        <a href="/">Retour</a>
        <div>
            <?php foreach ($waitingStudents as $student) { ?>
            <div>
                <?= $student ?> 
                <a href="#validate">Ajouter</a>
                <a href="#decline">X</a>
            </div>
            <?php } ?>
        </div>
    </body>
</html>
