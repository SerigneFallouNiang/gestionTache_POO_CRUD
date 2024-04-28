<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION["email"]) || !isset($_SESSION["password"]) || $_SESSION["role"] != "admin") {
    header("Location: index.php");
    exit;
}

// Inclure la configuration de la base de données
require_once "config.php";

// Récupérer toutes les tâches depuis la base de données
$results = $tache->readAllTaches();
?>
<link rel="stylesheet" href="admin.css">
<!-- Afficher les tâches dans un tableau -->
<table>
    <tr>
        <th>Libelle</th>
        <th>Description</th>
        <th>Date d'échéance</th>
        <th>Priorité</th>
        <th>État</th>
        <th>Utilisateur</th>
    </tr>
    <?php foreach ($results as $tache) : ?>
        <tr>
            <td><?= $tache['libelle'] ?></td>
            <td><?= $tache['description'] ?></td>
            <td><?= $tache['dateEcheange'] ?></td>
            <td><?= $tache['id_priorite'] ?></td>
            <td><?= $tache['libelleE'] ?></td>
            <td><?= $tache['nom'] . " " . $tache['prenom'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>