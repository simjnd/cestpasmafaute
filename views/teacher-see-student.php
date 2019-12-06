<!doctype html>
<html>
<head>
    <title>Profil de <?= $student->getFirstName() ?> <?= $student->getLastName() ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <p><?= $teacher->getFirstName() ?> <?= $teacher->getLastName() ?></p>
    <h2><?= $group->getName() ?></h2>
    <h1><?= $student->getFirstName().' '.$student->getLastName() ?></h1>
    <!-- Student's picture -->
    
    <h3><?= $totalPoints.' points' ?></h3>
    
    <table>
        <tr>
            <th>Last Connection</th>
            <th>Total Time Spent</th>
            <th>Global Average</th>
        </tr>
        <tr>
            <td><?= $student->getLastConnection() ?></td>
            <td><?= $student->getTotalTimeConnected() ?></td>
            <td><?= $globalAverage ?></td>
        </tr>
    </table>
    
    <?php foreach($difficulties as $difficulty) { ?>
    <table>
        <tr>
            <th>Difficulty: <?= $difficulty->getName() ?></th>
            <th>Average: <?= $student->getAverage($difficulty->getID()) ?></th>
        </tr>
        <?php foreach($steps as $step) { ?>
        <tr>
            <td><?= $step->getName() ?></td>
            <td><?= $step->getAverage($difficulty->getID()) ?></td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
    
    <a href="#">Move <?= $student->getFirstName() ?> to a different class</a>
    <a href="#">Remove from this class</a>
    
</body>
</html>