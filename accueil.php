<?php
require_once "config.php";
$results= $tache->readTache();
// require('header.php') ?>
<link rel="stylesheet" href="style.css">
<div class="banniere">
    <h1>Mes Tâches</h1>
</div>

<div class="container">
    
<div class="plus">
    <div>
         <h2>Liste des Taches</h2></div>
    
    <div>
        <a href="addTache.php"><img src="plus.png" alt=""></a></div>
    </div>
    

    
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
                        <a href="detail.php?id=<?= $taches['Tache']?>" class="btn btn-info"><img src="eye_icon.png" alt=""></a>
                        <a onclick="return confirm('Confirmer la suppression')" href="deleteTache.php?id=<?= $taches['Tache']?>" class="btn btn-danger"><img src="supprimer.png" alt=""></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>