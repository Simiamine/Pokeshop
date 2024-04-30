<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Client</title>
    <script src="../../js/pokemon.js" defer></script>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <link href="../../css/style_profil.css" rel="stylesheet">
    </head>

    <?php include_once('../../include/header.php'); ?>
    <script>
        $("#pokemon").addClass("active");  // Fonction pour mettre la class "active" en fonction de la page
    </script>

<br>
<main class ="main">
<div class="contenair d-flex"> 
<aside class="flex-grow-1">
    <div class="bg-light border rounded-3 p-1 h-100 sticky-top">
        <ul class="nav nav-pills flex-sm-column flex-row mb-auto justify-content-between text-truncate">
            <li class="my-1">
                <a href="compte_client.php" class="nav-link px-2 text-truncate">
                    <i class="bi bi-layout-text-sidebar-reverse"></i></i>
                    <span class="d-none d-sm-inline">Mon profil</span>
                </a>
            </li>
            <li class="my-1 nav-item">
                <a href="commande.php" class="nav-link px-2 text-truncate"><i class="bi bi-card-text fs-5"></i>
                    <span class="d-none d-sm-inline">Commandes</span> </a>
            </li>
            <li class="my-1">
                <a href="politique.php" class="nav-link px-2 text-truncate"><i class="bi bi-people fs-5"></i>
                    <span class="d-none d-sm-inline">Politiques</span> </a>
        </li>
        </ul>
    </div>
</aside>

<main class="flex-grow-4">
<main class="col overflow-auto h-100 w-100">
    <a class="btn btn-dark btn-sm" href="commande.php">← Retour</a><br><br>
    <div class="container py-2">
<?php
        // Récupération des données depuis la base de données
        require '../../include/databaseconnect.php';

        $id_commande = $_GET['id']; 
        $commande_query = $bdd->query("SELECT * FROM commandes WHERE id = $id_commande");
//si la base de donnée n'arrive pas a se connecter  alors un message s'affiche en expliquant le probleme 
        if ($commande_query === false) {
            print_r($bdd->errorInfo()); // Affiche le message d'erreur de PDO
//sinon la commande peut s'executer normalement
        } else {
            $commande = $commande_query->fetch(PDO::FETCH_ASSOC);
        }
        // Affichage de l'en-tête de la facture avec les données personnel du client 
        // son numero de commande, la date, le nom prenom, livraison et le total de commande
        echo "<h1>Facture Pokedex</h1>";
        echo "<p>Commande n° : ".$commande['numero_commande']."</p>";
        echo "<p>Date : ".$commande['date_creation']."</p>";
        echo "<p>Client : ".$commande['id_utilisateur']."</p>";
        echo "<p>Livraison : ".ucfirst($commande['adresse_livraison'])."</p>";
        echo "<p>Total : ".round($commande['total'],2)." €</p>";
    ?>
  <!-- en cliquant sur le bouton "imprimer page", il fait appel a un script qui permet d'imprimer la facture --->
  <form><input id="impression" name="impression" type="button" onclick="imprimer_page()"
                                value="Imprimer cette page" /></form>
                        <thead>
                            <!--- tableau affichant les differentes informations --->
                            <tr>
                                <th>Article</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                </tr>
                        </thead>
                        </tbody>
                   
                    </table>
                </div>
            </main>
        </div>
    </div>
    





<!-- SCRIPT QUI PERMET D'IMPRIMER LA FACTURE --->
    <script type="text/javascript">
    function imprimer_page() {
        window.print();
    }
    </script>