<?php 
    session_start();
    require  '../include/databaseconnect.php'
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/pokedex.js"></script>
        <title>Pokedex | Pokeshop</title>
        <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/pokedex.css">
        <link rel="icon" type="image/png" href="../img/icon.png"/>
    </head>

    <?php include_once('../include/header.php'); ?>
    <script>
        $("#pokedex").addClass("active");  // Fonction pour mettre la class "active" en fonction de la page
    </script>

<body>

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
}
    ?>

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
