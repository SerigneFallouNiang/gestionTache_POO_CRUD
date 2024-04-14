<?php
session_start();

// Redirection si les variables de session ne sont pas définies
if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
    header("Location: index.php");
    exit;
}

// Inclure la configuration de la base de données
require_once "config.php";

// Récupérer le nom de l'utilisateur à partir de la session
$nom = $_SESSION["nom"];
$prenom = $_SESSION["prenom"];
$email=$_SESSION["email"];
$id_user=$_SESSION['id'];
var_dump($id_user);
// Récupérer les tâches depuis la base de données
$results = $tache->readTache($id_user);

?>
<link rel="stylesheet" href="style.css">
<div class="banniere">
    <h1>Mes Tâches </h1>
</div>

<div class="container">
<h4 style="text-align:center">Welcome, <?php echo $nom . " " . $prenom; ?></h4>
<div class="plus">
    <div>
         <h2>Liste des Taches</h2></div>
    
    <div>
        <a href="addTache.php"><img src="images/plus.png" alt=""></a></div>
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
                <tr class="<?php echo ($taches['libelleE'] === 'Terminée') ? 'tableTermine' : ''; ?>">
                    <td><?= $taches['libelle']?> </td>
                    <td><?= $taches['dateEcheange']?></td>
                    <td><?= $taches['libelleE']?></td>
                    <td>
                        <a href="detail1.php?id=<?= $taches['Tache']?>" class="btn btn-info"><img src="images/eye_icon.png" alt=""></a>
                        <a onclick="return confirm('Confirmer la suppression')" href="deleteTache.php?id=<?= $taches['Tache']?>" class="btn btn-danger"><img src="images/supprimer.png" alt=""></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>