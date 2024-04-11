<?php
// Inclusion de la page de configuration avec les paramètres de connexion à la base de données
include 'config.php';
// require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voire Plus</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Mes Tâches</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <?php
                try {

                    $sql = "SELECT * ,Tache.id AS Tache 
                     FROM Tache
                    JOIN Etat ON Tache.id_etat = Etat.id
                    JOIN priorite ON Tache.id_priorite = priorite.id
                     WHERE Tache.id = :id";
                    $stmt = $connexion->prepare($sql);
                    $stmt->bindParam('id',$_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="card membre-card mb-3">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">Libelle:' . $row['libelle'] . '</h5>';
                            echo '<p class="card-text"><h3>Description :</h3> <br>' . $row['description'] . '</p>';
                            echo '<p class="card-text">Etat : ' . $row['libelleE'] . '</p>';
                            echo '<p class="card-text">Priorité: ' . $row['libelleP'] . '</p>';
                            echo '<a href="update.php?id=' . $row['Tache'] . '" class="btn btn-primary">Modifier</a>';
                            echo '<a onclick="return confirm("Confirmer la suppression")" href="deleteTache.php?id=' . $row['Tache'] . '" class="btn btn-danger">Supprimer</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "Aucun membre trouvé.";
                    }
                } catch (PDOException $e) {
                    // Gérer les erreurs PDO
                    echo "Erreur: " . $e->getMessage();
                }
                // Fermer la connexion à la base de données
                $connexion = null;
                ?>
            </div>
        </div>
    </div>
</div>
