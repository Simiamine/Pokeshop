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
                <li><a class="active" href="index.html" id="menu">Menu</a></li>
                <li><a href="php/pokedex.php" id="type">Pokedex</a></li>
                <li><a href="php/avantage.php" id="abonnement">Avantages</a></li>
                <li><a href="php/avantage.php" id="abonnement">Abonnement</a></li>
                <li><a href="#" id="contact">Contact</a></li>
                <li><a href="php/login.php" id="connexion">Connexion</a></li>
                <li><a id="panier"  href="#"> <i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
            </ul>
        </div>
    </section>

    <section id="hero">
        <h2>Achetez votre propre</h2>
        <h1>Pokémon !</h1>
        <button>Achetez dès maintenant !</button>
    </section>

      <div class="container mt-5">
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
                <img class="pokemon small" src="./img/001.png" />
                <p>la description du pokemon avec les details, les stats, le prix, la taille, le poid  </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="pokeball-wrapper">
                <img src="./img/pokeball.png" />
              </div>
              <div class="enhanced">
                <h2>Nom du pokemon</h2>
                <img class="pokemon small" src="./img/002.png" />
                <p>la description du pokemon avec les details, les stats, le prix, la taille, le poid  </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
             </div>
           </div>
            <div class="col-md-4">
              <div class="pokeball-wrapper">
                <img src="./img/pokeball.png" />
              </div>
              <div class="enhanced">
                <h2>Nom du pokemon</h2>
                <img class="pokemon small" src="./img/003.png" />
                <p>la description du pokemon avec les details, les stats, le prix, la taille, le poid </p>
                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </nav>

</body>
</html>