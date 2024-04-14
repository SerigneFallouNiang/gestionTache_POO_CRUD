<?php
include "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    // $user->addUser($nom,$prenom,$email,$password);
    

    if ($user->validerChaine($nom) && $user->validerChaine($prenom) && $user->validerEmail($email) && $user->validerTelephone($password)) {
     $user->addUser($nom,$prenom,$email,$password);
} else {
        echo 'Données invalides. Il faut bien vérifier les données soumit';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouveau membre</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!--Formulaire pour ajouter un membre avec des selects -->
<div class="container mt-5">
            <h2 class="mb-4">S'INSCRIRE</h2>
            <form method="POST" action="">
<div class="form-group">
            <label for="matricule">Nom:</label>
            <input type="text" class="form-control" id="libelle" name="nom" >
</div>
<div class="form-group">
            <label for="last_name">Prénom  :</label>
            <input class="form-control" id="last_name" name="prenom">
</div>
<div class="form-group">
            <label for="last_name">Email :</label>
            <input class="form-control" id="last_name" name="email">
</div>
<div class="form-group">
            <label for="last_name">password:</label>
            <input class="form-control" id="last_name" name="password">
</div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
</body>
</html>