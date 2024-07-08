<?php
    require 'config/env.php';
    $mysqlClient = connexion();

    // On vérifie si les champs ne sont pas vide et conformes au moment de la validation du formulaire.
    if(empty($_POST['titre'])
        || empty($_POST['artiste'])
        || empty($_POST['description'])
        || empty($_POST['image'])
        || strlen($_POST['description']) < 3
        || !filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
        header('Location: ajouter.php?erreur=true');
    } else {
        // Fonction qui échappe les caractères spéciaux dans une chaîne pour éviter les injections de code (XSS). 
        // Chaque champ du formulaire est sécurisé avant d'être utilisé.
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $artiste = htmlspecialchars($_POST['artiste']);
        $image = htmlspecialchars($_POST['image']);

        // Puis on insère notre oeuvre en base de données
        $req = $mysqlClient->prepare('INSERT INTO oeuvres (titre, description, artiste, image) VALUES (?, ?, ?, ?)');
        $req->execute([$titre, $description, $artiste, $image]);
    
        // $mysqlClient->lastInsertId() permet de récupérer l'id de la dernière ligne insérée en base de données (en l'occurence, l'oeuvre que nous venons d'ajouter).
        header('Location: oeuvre.php?id=' . $mysqlClient->lastInsertId());
    }
