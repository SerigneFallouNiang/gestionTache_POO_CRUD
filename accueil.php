<?php
require_once "config.php";
$results= $tache->readTache();
// require('header.php') ?>
<link rel="stylesheet" href="style.css">
<div class="_banniere">
    <h1>Les Tâches à faire </h1>
</div>

<div class="container">
<p><a href="addTache.php">Ajouter une Tâche</a></p>
    <h2>Liste des Taches</h2>
    
    <div class="card-body">
        <table class="table">
            <tr>
                <th>Libelle</th>
                <th>Date d'échéance</th>
                <th>Etat</th>
                <th>Voire</th>
            </tr>
            <?php foreach ($results as $taches) : ?>
                <tr>
                    <td><?= $taches['libelle']?> </td>
                    <td><?= $taches['dateEcheange']?></td>
                    <td><?= $taches['libelleE']?></td>
                    <td>
                        <a href="detail.php?id=<?= $taches['id']?>" class="btn btn-info">Voire Plus</a>
                        <a onclick="return confirm('Confirmer la suppression')" href="deleteTache.php?id=<?= $taches['id']?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>