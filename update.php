<?php
include "config.php";
$id = $_GET['id'];
$results= $tache->readTache($id_user);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    $tache->update($id,$libelle,$description,$dateEcheange,$id_priorite,$id_etat);
}
$sql="SELECT *,Tache.id AS Tache FROM Tache JOIN Etat ON Tache.id_etat=Etat.id WHERE Tache.id = :id" ;
$stmt=$connexion->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);
$stmt->execute();
$reponse=$stmt->fetchall(PDO::FETCH_ASSOC);
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
            <h2 class="mb-4">Ajouter une nouvelle Tâche</h2>
            <form method="POST" action="">
<div class="form-group">
            <label for="matricule">Libelle :</label>
            <input type="text" class="form-control" id="libelle" name="libelle"  value="<?php echo  $reponse[0]['libelle']?>" >
</div>
<div class="form-group">
            <label for="last_name">Description  :</label>
            <input class="form-control" id="last_name" name="description" value="<?php echo  $reponse[0]['description']?>">
</div>
<div class="form-group">
            <label for="dateEcheange">Date d'échéance :</label>
            <input type="date" class="form-control" id="last_name" name="dateEcheange" value="<?php echo  $reponse[0]['dateEcheange']?>">
</div>
<div class="form-group">
    <select name="id_etat" id="id_etat"  class="form-control">
                <?php 
                $reponse=$connexion->query('SELECT*FROM Etat');
                while($donnees=$reponse->fetch()){
                ?>
                <option value="<?php echo $donnees['id'];?>"><?php echo $donnees['libelleE'];?></option><br><?php
                }?>
    </select>
</div>
 
<div class="form-group">
    <select name="id_priorite" id="id_priorite"  class="form-control">
            <?php 
            $reponse=$connexion->query('SELECT*FROM priorite');
            while($donnees=$reponse->fetch()){
            ?>
            <option value="<?php echo $donnees['id'];?>"><?php echo $donnees['libelleP'];?></option><br><?php
            }?>
    </select>
</div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
</body>
</html>