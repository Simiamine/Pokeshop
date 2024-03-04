<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <script src="../js/pokemon.js" defer></script>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pokedex.css">
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

    <div class="pokedex">
        <header>
            <div class="search">
                <input type="text" class="search-input body-font" placeholder="Recherche par nom ou par id" id="search-input">
                <a id="recherche" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
        </header>
        <section class="pokemon-list">

   <div class="container"><br>
                <div class="list-wrapper">
        <div class="pokemon-card grass-poison">
            <span>#1 Bulbasaur</span>
            <!-- Image and Type tags go here -->
        </div>
        <!-- Repeat for other Pokémon -->
</div>
</div>
</body>
</html>