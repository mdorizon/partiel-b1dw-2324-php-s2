<?php
$id          = $_POST['id'];
$categorie   = $_POST['categorie'];
$groupe      = $_POST['groupe'];
$equipe1     = $_POST['equipe1'];
$equipe2     = $_POST['equipe2'];
$date_heure  = $_POST['date_heure'];
$lieu        = $_POST['lieu'];
$prix        = $_POST['prix'];
$description = $_POST['description'];

// vérifications des données entrées
if(!isset($id)) {
    header("Location: ../modify-post.php?error=Veuillez recharger la page");
    die();
}
if(!isset($categorie) || ($categorie != "Hommes" && $categorie != "Femmes")) {
    header("Location: ../modify-post.php?error=Veuillez renseigner une catégorie valide");
    die();
}
if(!isset($groupe)) {
    header("Location: ../modify-post.php?error=Veuillez renseigner un groupe");
    die();
}
if(!isset($equipe1)) {
    header("Location: ../modify-post.php?error=Veuillez renseigner la valeur de l'equipe 1");
    die();
}
if(!isset($equipe2)) {
    header("Location: ../modify-post.php?error=Veuillez renseigner la valeur de l'equipe 2");
    die();
}
if (!isset($date_heure)) {
    header("Location: ../modify-post.php?error=Veuillez renseigner la date et l'heure");
    die();
}
if (!DateTime::createFromFormat('Y-m-d\TH:i', $date_heure)) {
    header("Location: ../modify-post.php?error=Format de date/heure invalide");
    die();
}
if(!isset($lieu)) {
    header("Location: ../modify-post.php?error=Veuillez renseigner le lieu du match");
    die();
}
if (!isset($prix) || !filter_var(str_replace(',', '.', $prix), FILTER_VALIDATE_FLOAT)) {
    header("Location: ../modify-post.php?error=Veuillez renseigner un prix valide");
    die();
}
if(!isset($description)) {
    header("Location: ../modify-post.php?error=Veuillez renseigner la description");
    die();
}

// connect to db with PDO
$connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
// prepare request
$request = $connectDatabase->prepare("UPDATE post SET categorie=:cate, groupe=:grou, equipe1=:equ1, equipe2=:equ2, date_heure=:date, lieu=:lieu, prix=:prix, description=:grou WHERE id = :id");
// bind params
$request->bindParam(':id', $id);
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

header("Location: ../index.php");