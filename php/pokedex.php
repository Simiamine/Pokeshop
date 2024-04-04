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
        <li><a id="panier" href="panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo isset($_SESSION['panier'])? count($_SESSION['panier']) : 0; ?></span></a></li>    

        </ul>

        <?php else: ?>
            <ul id="navbar">
      <li><a  href="../index.php" id="menu">Menu</a></li>
      <li><a class="active" href="pokedex.php" id="type">Pokedex</a></li>
      <li><a  href="avantage.php" id="abonnement">Avantages</a></li>
      <li><a  href="contact.php" id="contact">Contact</a></li>
      <li><a href="login.php" id="connexion">Connexion</a></li>
      <li><a id="panier" href="panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo isset($_SESSION['panier'])? count($_SESSION['panier']) : 0; ?></span></a></li>    

        </ul>
<?php endif; ?>
</section>

    <div class="search-wrap">
        <input type="text" id="search-input" class="search-input" placeholder="Rechercher un pokemon">
        <button class="search-btn"><i class="fa-solid fa-search fa-lg"></i></button>
</div>
            </div></header></main></body></html>