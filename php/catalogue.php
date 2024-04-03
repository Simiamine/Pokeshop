<?php 
    session_start();
    require  '../include/databaseconnect.php'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/catalogue.js"></script>
    <title>Pokedex</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
     <!-- j'ai modifié -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    


   
    
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
        <li><a href="catalogue.php" id="type">Catalogue</a></li>
        <li><a href="#" id="type">Pokedex</a></li>
        <li><a href="#" id="compte">Compte</a></li>
        <li><a href="deconnexion.php" id="deconnexion">Déconnexion</a></li>
        <li><a id="panier" href="panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo count($_SESSION['panier']); ?></span></a></li>

        <?php else: ?>
            <ul id="navbar">
      <li><a  href="../index.php" id="menu">Menu</a></li>
      <li><a href="catalogue.php" id="type">Catalogue</a></li>
      <li><a  href="avantage.php" id="abonnement">Avantages</a></li>
      <li><a  href="contact.php" id="contact">Contact</a></li>
      <li><a href="login.php" id="connexion">Connexion</a></li>
      <li><a id="panier" href="panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo count($_SESSION['panier']); ?></span></a></li>
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

   <div class="card" style="width: 18rem; background-color: <?php echo $bg_color; ?>;" 
        data-name="<?php echo $pokemon['nom']; ?>" 
        data-image="../img/<?php echo $pokemon['image']; ?>" 
        data-description="<?php echo $pokemon['description']; ?>"
        data-type="<?php echo $pokemon['type_1']; ?>"
        data-type2="<?php echo $pokemon['type_2']; ?>"
        generation ="<?php echo $pokemon['generation']; ?>"
        legendaire ="<?php echo $pokemon['légendaire']; ?>"
        
        
    >

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
        <div class="popup-flex-container">
            <img id="pokemonImage" src="" alt="Image du Pokemon" />
            <div class="popup-text-content">
                <h3 id="pokemonName"></h3>
                    <h3 id="pokemonName"></h3>
            <div><strong>Génération : </strong><span id="generation" class="pokemon-generation"></span></div>
            <div><strong>Legendaire : </strong><span id="legendaire" class="pokemon-legendaire"></span></div>
            <div> <strong>description : </strong><span id="pokemonDescription"></span></div>
            <div><strong>Prix Initial : </strong><span id="initialPrice" class="pokemon-price"></span></div>
            <div><strong>Prix après Remise : </strong><span id="discountedPrice" class="pokemon-discounted-price"></span></div>
            

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Ajouter au Panier</button>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation d'ajout au panier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Votre Pokémon a été ajouté au panier.
            </div>
        </div>
    </div>
</div>












            </div>
        </div>
    </div>
</div>
</div>
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

document.addEventListener("DOMContentLoaded", function() {
    const cards = document.querySelectorAll('.card');
    const popup = document.getElementById('pokemonPopup');
    const popupName = document.getElementById('pokemonName');
    const popupImage = document.getElementById('pokemonImage');
    const popupDescription = document.getElementById('pokemonDescription');
    const closePopup = document.querySelector('.popup .close');

 // Fonction pour ouvrir la pop-up
function openPopup(name, image, description, generation, legendaire, price, discountedPrice) {
    popupName.textContent = name;
    popupImage.src = image;
    popupDescription.textContent = description;
    document.getElementById('generation').textContent = generation;
    document.getElementById('legendaire').textContent = legendaire === '1' ? 'Oui' : 'Non';
    // Set price and discounted price
    document.getElementById('initialPrice').textContent = price ; // j'ai modifié 
    document.getElementById('discountedPrice').textContent = discountedPrice ; // j'ai modifié 
    popup.style.display = 'block';
}


cards.forEach(card => {
    card.addEventListener('click', function() {
        const name = this.getAttribute('data-name');
        const image = this.getAttribute('data-image');
        const description = this.getAttribute('data-description');
        const generation = this.getAttribute('generation');
        const legendaire = this.getAttribute('legendaire');
        const priceElement = this.querySelector('.price') || this.querySelector('.original-price');
        const discountedPriceElement = this.querySelector('.discounted-price');
    
        const price = priceElement ? priceElement.textContent : 'N/A';
        const discountedPrice = discountedPriceElement ? discountedPriceElement.textContent : priceElement.textContent; // j'ai modifié 

        openPopup(name, image, description, generation, legendaire, price, discountedPrice);
    });
});

    // Gestionnaire de clic pour fermer la pop-up
    closePopup.addEventListener('click', function() {
        popup.style.display = 'none';
    });

    // j'ai modifié 
    document.querySelector('.button-ajouter').addEventListener('click', function() {
        // Récupérer les données du produit sélectionné
        const name = document.getElementById('pokemonName').textContent;
        //console.log(name);
        const price = document.getElementById('initialPrice').textContent;
        //console.log(price);
        const discountedPrice = document.getElementById('discountedPrice').textContent;
        //console.log(discountedPrice);

        // Créer un objet JSON contenant les informations du produit
        const produit = {
            nom: name,
            prix: price,
            prixApresRemise: discountedPrice
        };
        console.log(produit);

        // Envoyer les données du produit à la page ajouter_au_panier.php via une requête fetch
        fetch('ajouter_au_panier.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(produit)
        })
        .then(response => response.text())
        .then(data => {
            // Traiter la réponse de la page ajouter_au_panier.php si nécessaire
            console.log(data);
        })
        .catch(error => {
            console.error('Erreur lors de l\'ajout au panier:', error);
        });
        alert("Votre Pokémon a été ajouté au panier");
        location.reload();
    });
});
// j'ai modifié 
</script>
<style>
.button-ajouter {
    display: inline-block; 
    margin-top: 15px;
    padding: 10px 20px;
    color: white;
    border-radius: 5px; 
    transition: background-color 0.3s ease; 
}

.button-ajouter:hover {
    background-color: #45a049; 
}
 
#pokemonName {
    position: absolute; 
    top: 0; 
    left: 50%; 
    transform: translateX(-50%); /* Centre le nom horizontalement par rapport à sa propre largeur */
    font-size: 60px; 
    margin-top: 20px; 
}

.popup-content img {
    flex: 0.5; 
}

    /* Styles pour la pop-up */
.popup {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0,0,0,0.5); /* Fond semi-transparent */
    display: none; 
    justify-content: center; 
    align-items: center; 
    z-index: 1000; /* S'assure que la pop-up soit au-dessus des autres éléments */
   
}

.popup-content {
    margin: auto;
    background: white;
    width: 70%; 
    padding: 6%; 
    box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* ajoute une ombre pour un effet de profondeur */
    position: relative; 
    margin-top: 13%;
    border-radius: 9px;
}

.popup-flex-container {
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Aligner les éléments au début du conteneur */
}

.popup-text-content {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: -20px; /* Décaler vers le haut, ajustez selon le besoin */
}

#pokemonDescription {
    font-size: 20px; 
    text-align: center; 
    max-width: 120%; /* Limite la largeur du texte pour éviter qu'il ne soit trop étendu */
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

<?php include_once('../include/footer.php'); ?>
</html>


