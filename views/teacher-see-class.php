<!doctype html>
<html>
<head>
    <title><?= $class->getName() ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <p><?= $teacher->getFirstName() ?> <?= $teacher->getLastName() ?></p>
    <h1><?= $class->getName() ?></h1>

    <!-- Ajouter la moyenne de classe -->

    <table>
        <?php foreach($examinations as $examination) { ?>
            <tr>
                <td><?= $examination->getName() ?></td>
                <td><?= $examination->getPassword() ?></td>
            </tr>   
        <?php } ?>
    </table>
    
    <?php foreach ($students as $student) { ?>
        <!-- Avatar de l'étudiant -->
        <p><a href="/profile/<?= $student->getIdLogin() ?>"><?= $student->getFirstName() ?> <?= $student->getLastName() ?></a></p>
        <p><?= $student->getEmail() ?></p>
        <a href="#">Afficher menu contextuel (Déplacer / Supprimer)</a>
    <?php } ?>
</body>
</html>