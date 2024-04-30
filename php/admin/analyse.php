<?php 
    session_start();
    require  '../../include/databaseconnect.php';
    if (!isset($_SESSION['user_statut']) || $_SESSION['user_statut'] != "admin") {
        header('Location: ../../index.php');
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="icon" type="image/png" href="../../img/icon.png"/>

    </head>

    <?php include_once('../../include/header.php'); ?>
    <script>
        $("#pokemon").addClass("active");  // Fonction pour mettre la class "active" en fonction de la page
    </script>

<div class="mt-3 container-fluid pb-3 flex-grow-1 d-flex flex-column flex-sm-row overflow-auto">
        <div class="row flex-grow-sm-1 flex-grow-0 container-fluid">
            <main class="col overflow-auto h-100 w-100">
                <div class="container py-2">
                    <h2>Analyse</h2>
                    <?php
                    require  '../../include/databaseconnect.php';
                    $requete = $bdd->prepare("SELECT DATE_FORMAT(date_creation, '%Y-%m-%d') as day, SUM(total) as prix_sum FROM commandes GROUP BY day ORDER BY day");
                    $requete->execute();
                    $result = $requete->fetchAll(PDO::FETCH_ASSOC);
                    

                  // On va stocker des données dans des tableaux pour les utiliser en php
                  $day = array();
                  $prix = array();
                  foreach ($result as $row) {
                    
                    array_push($day, $row['day']);
                    array_push($prix, $row['prix_sum']);
                  }                  
                ?>

                <h4>Votre chiffre d'affaire :</h4>
                <!-- Création de l'élément canvas qui va contenir le graphe -->
                <canvas id="graphique1"></canvas>
                <script>
                var balise = document.getElementById('graphique1').getContext('2d');
                var graph = new Chart(balise, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($day); ?>,
                        datasets: [{
                            label: 'Chiffre d\'affaires en fonction des ventes',
                            data: <?php echo json_encode($prix); ?>,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
  scales: {
    y: {  
      beginAtZero: true,
      title: {  // Remplacez 'scaleLabel' par 'title'
        display: true,
        text: 'Somme total des ventes '
      }
    },
    x: { 
      title: {
        display: true,
        text: 'Jour'
      }
    }
  }
}

                });
                </script>
                <br><br>