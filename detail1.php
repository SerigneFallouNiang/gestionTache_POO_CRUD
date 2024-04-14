<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voire Plus</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Ajoutez votre propre style ici */
        .task-table {
            width: 100%;
            border-collapse: collapse;
        }
        .task-table th, .task-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .task-table th {
            background-color: #f2f2f2;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
        .description-cell {
            min-height: 100px; /* Ajustement de la hauteur de la cellule de description */
        }
        .btn-container .btn {
            width: 48%; /* Largeur des boutons */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Mes Tâches</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <?php
                try {
                    $sql = "SELECT *, Tache.id AS TacheId 
                            FROM Tache
                            JOIN Etat ON Tache.id_etat = Etat.id
                            JOIN priorite ON Tache.id_priorite = priorite.id
                            WHERE Tache.id = :id";
                    $stmt = $connexion->prepare($sql);
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        echo '<table class="task-table">';
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<th>Libelle</th><td>' . $row['libelle'] . '</td>';
                            echo '</tr>';
                            echo '<tr class="description-cell">'; // Ajout de la classe pour la cellule de description
                            echo '<th>Description</th><td>' . $row['description'] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th>Etat</th><td>' . $row['libelleE'] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<th>Priorité</th><td>' . $row['libelleP'] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td colspan="2">';
                            echo '<div class="btn-container">'; // Div pour les boutons
                            echo '<a href="update.php?id=' . $row['TacheId'] . '" class="btn btn-primary">Modifier</a>';
                            echo '<a onclick="return confirm(\'Confirmer la suppression\')" href="deleteTache.php?id=' . $row['TacheId'] . '" class="btn btn-danger">Supprimer</a>';
                            echo '</div>'; // Fin de la div pour les boutons
                            echo '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo "Aucune tâche trouvée.";
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

</body>
</html>
