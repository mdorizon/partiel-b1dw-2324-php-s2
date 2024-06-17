<?php
    $categorie   = $_POST['categorie'];
    $groupe      = $_POST['groupe'];
    $equipe1     = $_POST['equipe1'];
    $equipe2     = $_POST['equipe2'];
    $date_heure  = $_POST['date_heure'];
    $lieu        = $_POST['lieu'];
    $prix        = $_POST['prix'];
    $description = $_POST['description'];

    // vérifications des données entrées
    if(!isset($categorie) || ($categorie != "Hommes" && $categorie != "Femmes")) {
        header("Location: ../new-post.php?error=Veuillez renseigner une catégorie valide");
        die();
    }
    if(!isset($groupe)) {
        header("Location: ../new-post.php?error=Veuillez renseigner un groupe");
        die();
    }
    if(!isset($equipe1)) {
        header("Location: ../new-post.php?error=Veuillez renseigner la valeur de l'equipe 1");
        die();
    }
    if(!isset($equipe2)) {
        header("Location: ../new-post.php?error=Veuillez renseigner la valeur de l'equipe 2");
        die();
    }
    if (!isset($date_heure)) {
        header("Location: ../new-post.php?error=Veuillez renseigner la date et l'heure");
        die();
    }
    if (!DateTime::createFromFormat('Y-m-d\TH:i', $date_heure)) {
        header("Location: ../new-post.php?error=Format de date/heure invalide");
        die();
    }
    if(!isset($lieu)) {
        header("Location: ../new-post.php?error=Veuillez renseigner le lieu du match");
        die();
    }
    if (!isset($prix) || !filter_var(str_replace(',', '.', $prix), FILTER_VALIDATE_FLOAT)) {
        header("Location: ../new-post.php?error=Veuillez renseigner un prix valide");
        die();
    }
    if(!isset($description)) {
        header("Location: ../new-post.php?error=Veuillez renseigner la description");
        die();
    }

    // connect to db with PDO
    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
    // prepare request
    $request = $connectDatabase->prepare("INSERT INTO post (categorie, groupe, equipe1, equipe2, date_heure, lieu, prix, description) VALUES (:cate, :grou, :equ1, :equ2, :date, :lieu, :prix, :desc)");
    // bind params
    $request->bindParam(':cate', $categorie);
    $request->bindParam(':grou', $groupe);
    $request->bindParam(':equ1', $equipe1);
    $request->bindParam(':equ2', $equipe2);
    $request->bindParam(':date', $date_heure);
    $request->bindParam(':lieu', $lieu);
    $request->bindParam(':prix', $prix);
    $request->bindParam(':desc', $description);
    // execute request
    $request->execute();

    header("Location: ../new-post.php?success=Le billet a bien été ajouté !");