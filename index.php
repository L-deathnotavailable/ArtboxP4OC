<?php
    require 'header.php';
    require 'config/env.php';

    $mysqlClient = connexion();
    $sqlQuery = 'SELECT * FROM oeuvres';
    $Statmentoeuvres = $mysqlClient->prepare($sqlQuery);
    $Statmentoeuvres->execute();
    $oeuvres = $Statmentoeuvres->fetchAll();
?>
<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
