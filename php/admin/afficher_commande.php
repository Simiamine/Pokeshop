<?php 
    session_start();
    require  '../../include/databaseconnect.php';

    // Check if the user is logged in and has admin privileges
    if (!isset($_SESSION['user_statut']) || $_SESSION['user_statut'] != "admin") {
        header('Location: ../../index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajouter un produit</title>
        <script src="../js/pokemon.js" defer></script>
        <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/bootstrap.css">
        <link rel="icon" type="image/png" href="../../img/icon.png"/>
    </head>
    <body>
        <?php include_once('../../include/header.php'); ?>
        <script>
            $("#pokemon").addClass("active");  // Fonction pour mettre la class "active" en fonction de la page
        </script>
  
        <div class="mt-3 container-fluid pb-3 flex-grow-1 d-flex flex-column flex-sm-row overflow-auto">
            <div class="row flex-grow-sm-1 flex-grow-0 container-fluid">
                <main class="col overflow-auto h-100 w-100">
                    <div class="container py-2">
                        <h2>Liste des commandes</h2>
                        <table class="table table-striped table-hover">
                            <!-- Début de l'en-tête du tableau -->
                            <thead>
                                <tr>
                                    <!-- Définition des colonnes du tableau -->
                                    <th>#ID</th>
                                    <th>Client</th>
                                    <th>Numéro commande</th>
                                    <th>Ville</th>
                                    <th>Code postal</th>
                                    <th>Livraison</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Récupération des données depuis la base de données
                                $requete = $bdd->query("SELECT commandes.*, utilisateur.nom, utilisateur.prenom FROM commandes
                                                        INNER JOIN utilisateur ON commandes.id_utilisateur = utilisateur.id
                                                        ORDER BY commandes.date_creation DESC");

                                while ($commande = $requete->fetch()) {
                                    echo "<tr>";
                                    echo "<td>" . $commande['id'] . "</td>";
                                    echo "<td>" . htmlspecialchars($commande['prenom'] . ' ' . $commande['nom']) . "</td>";
                                    echo "<td>" . htmlspecialchars($commande['numero_commande']) . "</td>";
                                    echo "<td>" . htmlspecialchars($commande['ville']) . "</td>";
                                    echo "<td>" . htmlspecialchars($commande['code_postal']) . "</td>";
                                    
                                    // Check if 'livraison' key exists before accessing it
                                    echo "<td>" . (isset($commande['livraison']) ? htmlspecialchars($commande['livraison']) : 'N/A') . "</td>";
                                    
                                    echo "<td>" . htmlspecialchars($commande['total']) . "€</td>";
                                    echo "<td>" . htmlspecialchars($commande['date_creation']) . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
