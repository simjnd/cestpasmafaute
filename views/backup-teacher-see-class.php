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
    
    <h3>Liste des élèves de la classe</h3>
    <table>
        <?php foreach ($students as $student) { ?>
            <tr>
                <!-- Avatar de l'étudiant -->
                <td><a href="/profile/<?= $student->getIdLogin() ?>"><?= $student->getFirstName() ?> <?= $student->getLastName() ?></a></td>
                <td><?= $student->getEmail() ?></td>
                <td><a href="#">Afficher menu contextuel (Déplacer / Supprimer)</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>