<?php 
    $connectDatabase = new PDO("mysql:host=db;dbname=wordpress", "root", "admin");
    $request = $connectDatabase->prepare("DELETE FROM post WHERE id= :id");
    $request->bindParam(':id', $_GET['id']);
    $request->execute();
    header("Location: ../index.php");