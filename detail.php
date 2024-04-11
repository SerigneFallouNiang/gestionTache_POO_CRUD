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

<div class="app min-h-screen bg-grey-light font-sans overflow-hidden">

  <div class="h-32 flex items-center justify-center bg-red">
    <h1 class="text-2xl text-teal-darkest -mt-8">Details &amp; Summary</h1>
  </div>

  <div class="wrapper border-b-2 -mt-8 bg-white overflow-hidden mx-auto max-w-sm rounded shadow-lg">

    <h3 class="bg-grey-lightest px-8 py-6 font-semibold">

      Frequently Asked Questions</h3>

    <div class="question-wrap mx-8 mt-2">
      <details class="question py-4 border-b border-grey-lighter">

        <summary class="flex items-center">Security
          <button class="ml-auto">
          <svg class="fill-current opacity-75 w-4 h-4 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
        </button>
        </summary>

        <div class="mt-4 leading-normal text-sm ">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga perspiciatis quidem sunt animi. Veniam accusamus illum, iste, hic aperiam ratione nemo, doloremque aliquid ipsum magnam dolorum cumque ducimus! Nobis, officia.</div>
      </details>

      <details class="question py-4 border-b border-grey-lighter">

        <summary class="flex items-center">Pricing
          <button class="ml-auto">
          <svg class="fill-current opacity-75 w-4 h-4 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
        </button>
        </summary>

        <div class="mt-4 leading-normal text-sm">
          <ul>
            <li>Cash on hand: $500.00</li>
            <li>Current invoice: $75.30</li>
            <li>Due date: 5/6/19</li>
          </ul>
        </div>
      </details>

      <details class="question py-4 border-b border-grey-lighter">

        <summary class="flex items-center">How to change avatar?
          <button class="ml-auto">
          <svg class="fill-current opacity-75 w-4 h-4 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
        </button>
        </summary>

        <div class="mt-4 leading-normal text-sm ">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga perspiciatis quidem sunt animi. Veniam accusamus illum, iste, hic aperiam ratione nemo, doloremque aliquid ipsum magnam dolorum cumque ducimus! Nobis, officia.</div>
      </details>
    </div>

    <a href="#" class="text-right block py-6 px-8 no-underline text-grey-darker hover:underline hover:text-black text-sm">See all</a>

  </div>

  <footer class="text-center py-8 text-grey-dark">
    built with tailwindcss
  </footer>

</div>