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
        <li><a class="active" href="index.html" id="menu">Menu</a></li>
        <li><a href="php/pokedex.php" id="type">Pokedex</a></li>
        <li><a href="php/avantage.php" id="abonnement">Avantages</a></li>
        <li><a href="php/contact.php" id="contact">Contact</a></li>
        <li><a href="php/deconnexion.php" id="deconnexion">Déconnexion</a></li>
        <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>


        <?php elseif (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'admin'): ?>
          <li>Compte_Admin </li>
        <li><a class="active" href="index.html" id="menu">Menu</a></li>
        <li><a href="#" id="type">Analyse</a></li>
        <li><a href="php/ajout_pok.php" id="abonnement"> Pokemons</a></li>
        <li><a href="#" id="contact">Commandes</a></li>
        <li><a href="php/deconnexion.php" id="deconnexion">Déconnexion</a></li>

        <?php else: ?>
      <li><a class="active" href="index.html" id="menu">Menu</a></li>
      <li><a href="php/pokedex.php" id="type">Pokedex</a></li>
      <li><a href="php/avantage.php" id="abonnement">Avantages</a></li>
      <li><a href="php/contact.php" id="contact">Contact</a></li>
      <li><a href="php/login.php" id="connexion">Connexion</a></li>
      <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
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

      <div class="container mt-5"><br><br><br><br><br>
        <h2 class="text-center">Les meilleures ventes</h2><br>
    </div>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="pokeball-wrapper">
                <img src="./img/pokeball.png" />
              </div>
              <div class="enhanced">
                <h2>Nom du pokemon</h2>
                <img class="pokemon small" src="./img/pokemon2.png" />
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="pokeball-wrapper">
                <img src="./img/pokeball.png" />
              </div>
              <div class="enhanced">
                <h2>Nom du pokemon</h2>
                <img class="pokemon small" src="./img/pokemon3.png" />
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
             </div>
           </div>
            <div class="col-md-4">
              <div class="pokeball-wrapper">
                <img src="./img/pokeball.png" />
              </div>
              <div class="enhanced">
                <h2>Nom du pokemon</h2>
                <img class="pokemon small" src="./img/pokemon1.png" />
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus fermentum massa amet justo sit risus.</p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </nav>

</body>
</html>