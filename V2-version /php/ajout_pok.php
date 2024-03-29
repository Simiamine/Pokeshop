<?php 
    session_start();
    require  '../include/databaseconnect.php'
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <script src="../js/pokemon.js" defer></script>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    </head>

    <section id="header">
        <div class="logo">
            <a href="../index.php"><img src="../img/icon.png" alt="pokeball" class = "logo" width="50"></a>
        </div>

        <?php if (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'client'): ?>
        <ul id="navbar">
        <li>Bonjour, <?= htmlspecialchars($_SESSION['user_name']); ?></li>
        <li><a  href="../index.php" id="menu">Menu</a></li>
        <li><a href="#" id="type">Pokedex</a></li>
        <li><a  href="avantage.php" id="abonnement">Avantages</a></li>
        <li><a href="contact.php" id="contact">Contact</a></li>
        <li><a href="deconnexion.php" id="deconnexion">Déconnexion</a></li>
        <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
        </ul>

        <?php elseif (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'admin'): ?>
            <ul id="navbar">
          <li>Compte_Admin </li>
        <li><a href="../index.php" id="menu">Menu</a></li>
        <li><a href="#" id="type">Analyse</a></li>
        <li><a class="active" href="ajout_pok.php" id="abonnement"> Pokemons</a></li>
        <li><a href="#" id="contact">Commandes</a></li>
        <li><a href="deconnexion.php" id="deconnexion">Déconnexion</a></li>
            </ul>

        <?php else: ?>
            <ul id="navbar">
      <li><a  href="../index.php" id="menu">Menu</a></li>
      <li><a href="pokedex.php" id="type">Pokedex</a></li>
      <li><a href="avantage.php" id="abonnement">Avantages</a></li>
      <li><a href="contact.php" id="contact">Contact</a></li>
      <li><a href="login.php" id="connexion">Connexion</a></li>
      <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
        </ul>
<?php endif; ?>
    </section>

<div class="mt-3 container-fluid pb-3 flex-grow-1 d-flex flex-column flex-sm-row overflow-auto">
        <div class="row flex-grow-sm-1 flex-grow-0 container-fluid">
            <main class="col overflow-auto h-100 w-100">
                <div class="container py-2">
                    <h2>Liste des pokemons</h2>
                    <a href="ajout_produit_pokemon.php" class="btn btn-primary">Ajouter produit</a>
                    <table class="table table-striped table-hover">
                        <!-- Début de l'en-tête du tableau -->
                        <thead>
                            <tr>
                                <!-- Définition des colonnes du tableau -->
                        
                                <th>Nom</th>
                                <th>1er type</th>
                                <th>2eme type</th>
                                <th>Generation</th>
                                <th>Legendaire</th>
                                <th>Prix</th>
                                <th>Discount</th>
                                <th> Description</th>
                                <th>Quantité</th>
                                <th>Image</th>
                    
                                <th>Opérations</th>
                            </tr>
                        </thead>
  <!-- Début de la ligne du tableau pour le produit -->
  <?php
// Récupération des données depuis la base de données
$requete = $bdd->query("SELECT * FROM Pokedex");
while ($pokemon = $requete->fetch()) {
    echo "<tr>";
    echo "<td>" . $pokemon['nom'] . "</td>";
    echo "<td>" . $pokemon['type_1'] . "</td>";
    echo "<td>" . $pokemon['type_2'] . "</td>";
    echo "<td>" . $pokemon['generation'] . "</td>";
    echo "<td>" . $pokemon['légendaire'] . "</td>";
    echo "<td>" . $pokemon['prix'] . "</td>";
    echo "<td>" . $pokemon['discount'] . "</td>";
    echo "<td>" . $pokemon['description'] . "</td>";
    echo "<td>" . $pokemon['quantité'] . "</td>";
    echo "<td><img src='../img/" . $pokemon['image'] . "' alt='Image du pokemon' width='90'></td>";
    
    echo "<td>
            <!-- Bouton pour supprimer le produit -->
            <a class='btn btn-primary' href='#'> Modifier</a>
            <a class='btn btn-danger' href='supp_produit.php?id=" . $pokemon['id'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer le produit " . addslashes($pokemon['nom']) . " ?')\">Supprimer</a></td>";
    echo "</tr>";
}

?>

            
                         <!-- Fin du tableau -->
                    </table>