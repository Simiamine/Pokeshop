<?php 
    session_start();
    require  '../include/databaseconnect.php'

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/pokedex.js"></script>
    <title>Pokedex</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/pokedex.css">
    <link rel="stylesheet" href="../css/style.css">
    
    </head>

    <body>
        <main class ="main">
            <header class = header-home>
            <div class = "contenair">     
            <section id="header">
        <div class="logo">
            <a href="../index.php"><img src="../img/icon.png" alt="pokeball" class = "logo" width="50"></a>
        </div>

        <?php if (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'client'): ?>
        <ul id="navbar">
        <li>Bonjour, <?= htmlspecialchars($_SESSION['user_name']); ?></li>
        <li><a  href="../index.php" id="menu">Menu</a></li>
        <li><a  class="active" href="php/pokedex.php" id="type">Pokedex</a></li>
        <li><a href="#" id="enchere"> Enchere </a></li>
        <li><a  href="avantage.php" id="abonnement">Avantages</a></li>
        <li><a  href="contact.php" id="contact">Contact</a></li>
        <li><a href="deconnexion.php" id="deconnexion">Déconnexion</a></li>
        <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
        </ul>

        <?php elseif (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'admin'): ?>
            <ul id="navbar">
          <li>Compte_Admin </li>
        <li><a href="index.php" id="menu">Menu</a></li>
        <li><a href="#" id="type">Analyse</a></li>
        <li><a  href="php/ajout_pok.php" id="abonnement"> Pokemons</a></li>
        <li><a href="#" id="contact">Commandes</a></li>
        <li><a href="php/deconnexion.php" id="deconnexion">Déconnexion</a></li>
            </ul>

        <?php else: ?>
            <ul id="navbar">
      <li><a  href="../index.php" id="menu">Menu</a></li>
      <li><a class="active" href="pokedex.php" id="type">Pokedex</a></li>
      <li><a  href="avantage.php" id="abonnement">Avantages</a></li>
      <li><a  href="contact.php" id="contact">Contact</a></li>
      <li><a href="login.php" id="connexion">Connexion</a></li>
      <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
        </ul>
<?php endif; ?>
</section>

<div class="search-wrapper">
    <div class="search-wrap">
        <input type="text" id="search-input" class="search-input" placeholder="Rechercher un pokemon">
        <button class="search-btn"><i class="fa-solid fa-search fa-lg"></i></button>
</div>
<div class="filter-wrapper">
    <p class="filter-title">Filtrer par type</p>
    <div>
        <input type="checkbox" id="type" name="filtesr" value="type"/>
        <label for="type" class="">Type</label>
    </div>
    <div>
        <input type="checkbox" id="name" name="filtesr" value="name"/>
        <label for="name" class="">Nom</label>
    </div>
<section class="pokemon-list">
    <div class="container">
        <div class="list-wrapper"></div>
    </div>
<div id=not-found-message>
    <p>Aucun pokemon trouvé</p>
</div>
<div class="catalogue">
<?php
// Récupération des données depuis la base de données
$requete = $bdd->query("SELECT * FROM Pokedex");
foreach ($requete as $pokemon) {
    echo"<div class='cadre'>";
    echo "<tr>";
    echo "<td>" . $pokemon['nom'] . "</td>";
    echo"<br>";
    echo "<td>" . $pokemon['type_1'] . "</td>";
    echo "<td>" . $pokemon['type_2'] . "</td>";
    echo"<br>";
    echo "<td><img src='../img/" . $pokemon['image'] . "' alt='Image du pokemon' width='90'></td>";
    echo"<br>";
    echo "<td>" . $pokemon['generation'] . "</td>";
    echo"<br>";
    echo "<td>" . $pokemon['légendaire'] . "</td>";
    echo"<br>";
    echo "<td>" . $pokemon['prix'] . "</td>";
    echo"<br>";
    echo "<td>" . $pokemon['discount'] . "</td>";
    echo"<br>";
    echo "<td>" . $pokemon['description'] . "</td>";
    echo"<br>";
    echo "<td>" . $pokemon['quantité'] . "</td>";
    echo"<br>";
    echo"</div>";

}

?>
</div>
</section>


 
</body>
</html>
