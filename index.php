<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeshop</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
</head>
<body>
    <section id="header">
        <div class="logo">
            <a href="#"><img src="img/icon.png" alt="pokeball" class = "logo" width="50"></a>
        </div>
        <div>
        <ul id="navbar">

        <?php if (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'client'): ?>
        <li>Bonjour, <?= htmlspecialchars($_SESSION['user_name']); ?></li>
        <li><a class="active" href="#" id="menu">Menu</a></li>
        <li><a href="php/catalogue.php" id="type">Catalogue</a></li>
        <li><a href="#" id="type">Pokedex</a></li>
        <li><a href="php/client/compte_client.php" id="compte">Compte</a></li>
        <li><a href="php/deconnexion.php" id="deconnexion">Déconnexion</a></li>
        <!-- j'ai modifié -->
        <li><a id="panier" href="php/panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo count($_SESSION['panier']); ?></span></a></li> 


        <?php elseif (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'admin'): ?>
          <li>Compte_Admin </li>
        <li><a class="active" href="#" id="menu">Menu</a></li>
        <li><a href="#" id="type">Analyse</a></li>
        <li><a href="php/admin/ajout_pok.php" id="pokemon"> Pokemons</a></li>
        <li><a href="#" id="contact">Commandes</a></li>
        <li><a href="php/deconnexion.php" id="deconnexion">Déconnexion</a></li>

        <?php else: ?>
      <li><a class="active" href="#" id="menu">Menu</a></li>
      <li><a href="php/catalogue.php" id="type">Catalogue</a></li>
      <li><a href="php/avantage.php" id="abonnement">Avantages</a></li>
      <li><a href="php/contact.php" id="contact">Contact</a></li>
      <li><a href="php/login.php" id="connexion">Connexion</a></li>
      <!-- j'ai modifié -->
      <li><a id="panier" href="php/panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo count($_SESSION['panier']); ?></span></a></li> 

<?php endif; ?>
</ul>

</ul>
        </div>
    </section>

    <section id="hero">
        <h2>Achetez votre propre</h2>
        <h1>Pokémon !</h1>
        <button>Achetez dès maintenant !</button>
    </section>

      </div>
    </nav>

</body>
<?php include_once('include/footer.php'); ?>
</html>
