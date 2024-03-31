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
        <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
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

    <div class="search-wrap">
        <input type="text" id="search-input" class="search-input" placeholder="Rechercher un pokemon">
        <button class="search-btn"><i class="fa-solid fa-search fa-lg"></i></button>
</div>

<div class="cards-container">
<?php
$requete = $bdd->query("SELECT * FROM Pokedex");
foreach ($requete as $pokemon) {
    $bg_color = "#929da3";
    
    switch ($pokemon['type_1']) {
        case 'feu':
            $bg_color = "#fe9d54";
            break;
        case 'plante':
            $bg_color = "#63bc5a";
            break;
        case 'eau':
            $bg_color = "#5190d7";
            break;
        default:
            echo "";
            break;
    }
    
    ?>
   <div class="card" style="width: 18rem; background-color: <?php echo $bg_color; ?>;" data-name="<?php echo $pokemon['nom']; ?>" data-image="../img/<?php echo $pokemon['image']; ?>" data-description="Description ici">
    <!-- Contenu de la carte -->
        <div class="card-img-top-container">
            <img src="../img/<?php echo $pokemon['image']; ?>" class="card-img-top" alt="Image du pokemon">
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $pokemon['nom']; ?></h5>
            <p class="card-text">
                <span class="pokemon-type"><?php echo $pokemon['type_1']; ?></span>
                <span class="pokemon-type"><?php echo $pokemon['type_2']; ?></span>
            </p>

    <?php
        $prixOriginal = floatval($pokemon['prix']);
        $remise = floatval($pokemon['discount']);

        // Vérifie si une remise est appliquée
        if ($remise > 0) {
            $prixApresRemise = $prixOriginal - ($prixOriginal * ($remise / 100));
            ?>
            <p class="card-text">
                Prix Original: <span class="original-price"><?php echo number_format($prixOriginal, 2, '.', ''); ?>€</span>
            </p>
            <div class="card-footer">
                Prix remise: 
                <span class="discounted-price"><?php echo number_format($prixApresRemise, 2, '.', ''); ?>€</span>
            </div>
            <?php
        } else {
            // Affiche simplement le prix original sans le barrer
        ?>
            <p class="card-text">
                Prix: <span class="price"><?php echo number_format($prixOriginal, 2, '.', ''); ?>€</span>
            </p>
    <?php
    }
?>
    </div>
    </div>

<div id="pokemonPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h3 id="pokemonName"></h3>
            <img id="pokemonImage" src="" alt="Image du Pokemon" />
            <p id="pokemonDescription"></p>
        </div>
    </div>

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const cards = document.querySelectorAll('.card');
    const popup = document.getElementById('pokemonPopup');
    const popupName = document.getElementById('pokemonName');
    const popupImage = document.getElementById('pokemonImage');
    const popupDescription = document.getElementById('pokemonDescription');
    const closePopup = document.querySelector('.popup .close');

    // Fonction pour ouvrir la pop-up
    function openPopup(name, image, description) {
        popupName.textContent = name;
        popupImage.src = image;
        popupDescription.textContent = description;
        popup.style.display = 'block';
    }

    // Gestionnaire de clics sur les cartes
    cards.forEach(card => {
        card.addEventListener('click', function() {
            const name = this.getAttribute('data-name');
            const image = this.getAttribute('data-image');
            const description = this.getAttribute('data-description');
            openPopup(name, image, description);
        });
    });

    // Gestionnaire de clic pour fermer la pop-up
    closePopup.addEventListener('click', function() {
        popup.style.display = 'none';
    });
});
</script>

<?php
    }
 ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('search-input');
    const cards = document.querySelectorAll('.card');
    
    searchInput.addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        
        cards.forEach(card => {
            const name = card.querySelector('.card-title').textContent.toLowerCase();
            if (name.includes(searchText)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>

<style>

#pokemonName {
    position: absolute; 
    top: 0; /* Place le nom en haut du conteneur .popup-content */
    left: 50%; /* Déplace le nom à 50% de la gauche du conteneur */
    transform: translateX(-50%); /* Centre le nom horizontalement par rapport à sa propre largeur */
    font-size: 60px; /* Ajustez cette valeur selon vos besoins pour agrandir la taille de la police */
    margin-top: 20px; /* Ajustez si nécessaire pour l'espacement au-dessus du nom */
}


.popup-content img {
    max-width: 100%; /* Largeur maximale pour l'image */
    max-height: 100vh; /* Hauteur maximale basée sur la hauteur de l'écran */  
}

    /* Styles pour la pop-up */
.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 500%; 
    background-color: rgba(0,0,0,0.8); /* Fond semi-transparent */
    display: none; /* Commence caché */
    justify-content: center; 
    align-items: center; 
    z-index: 1000; /* S'assure que la pop-up soit au-dessus des autres éléments */
}

.popup-content {
    margin: auto;
    background: white;
    width: 70%; 
    padding: 14%; 
    box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* ajoute une ombre pour un effet de profondeur */
    position: relative; 
    margin-top: 4%;
}

.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 30px;
    color: #000;
    cursor: pointer;
}

    /*style pour le prix */ 
.original-price {
  text-decoration: line-through; /* Barre le prix original */
  color: #9e9e9e; 
}

.discounted-price {
  color: red; /* Met le nouveau prix en rouge */
  font-weight: bold; 
}

     /*style pour la barre de recherche */ 
.search-wrap {
    display: flex;
    margin-top: 2.5%;
    width: 50%;
    padding: 5px;
    background-color: #757575; 
    margin-left: 25%;
}

.search-input {
    flex-grow: 1;
    padding: 8px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
}

.search-btn {
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 8px;
    margin-left: 5px;
    cursor: pointer;
}

     /*style pour le contenue du pokemon */ 
.cards-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly; 
  align-items: center; /* Aligner les cartes sur le haut */
  margin-right: 10%;
  margin-left: 9%;
}

.card {
  box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2);
  transition: 0.3s;
  border-radius: 9px;
  overflow: hidden;
  margin: 2rem;
  flex-basis: 20%;
  max-width: 20%; /* Empêche les cartes de devenir plus grandes que 20% de la largeur du conteneur */
  cursor: pointer;

}

.card:hover {
  box-shadow: 0 8px 20px 0 rgba(0, 0, 0, 0.2);
}

.card-img-top-container {
  padding: 2.6rem;
  background-color: white; 
}

.card-img-top {
  width: 100%;
  object-fit: contain;
}

.card-body {
  padding: 3rem;
}

.card-title {
  font-size: 1.5rem;
}

.card-text {
  font-size: 1rem;
  color: #757575;
}

.pokemon-type {
  display: block;
}


@media (max-width: 991px) {
  .card {
    flex-basis: 48%; /* Sur les tablettes, deux cartes par ligne */
    max-width: 48%;
  }
}

@media (max-width: 767px) {
  .card {
    flex-basis: 100%; /* Sur les mobiles, une carte par ligne */
    max-width: 100%;
  }
}
</style>


 
</body>
</html>
