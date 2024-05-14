<?php 
    session_start();
    require  '../include/databaseconnect.php'
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/catalogue.js"></script>
    <title>Pokedex</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../img/icon.png"/>
     <!-- j'ai modifié -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
// Vérification que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "<p>Vous devez être connecté pour voir vos commandes.</p>";
    exit; // Stoppe l'exécution du script si l'utilisateur n'est pas connecté
}

// Utilisation de l'ID de l'utilisateur connecté pour filtrer les commandes
$userId = $_SESSION['user_id'];

// Requête SQL avec jointures pour obtenir les commandes de l'utilisateur connecté, les noms et types des Pokémon
// $requete = $bdd->prepare("
//     SELECT lc.id, lc.id_commande, lc.pokemon, p.nom as nom_pokemon, p.type_1, p.type_2, p.generation, p.légendaire, p.prix, p.discount, p.image, p.description
//     FROM ligne_commandes lc
//     JOIN commandes c ON lc.id_commande = c.id
//     JOIN pokedex p ON lc.id_pokemon = p.id
//     WHERE c.id_utilisateur = :userId
// ");

$sql = "SELECT lc.pokemon
        FROM ligne_commandes lc
        JOIN commandes c ON lc.id_commande = numero_commande
        WHERE c.id_utilisateur = :userId"; 
$requete = $bdd -> prepare($sql);
$requete->bindParam(':userId', $userId, PDO::PARAM_INT);
$requete->execute();
$pokedex = array();  // Liste vide qui va contenir les id des pokemons
while ($ligne_commandes = $requete->fetch(PDO::FETCH_ASSOC)) {
    $pokemon = json_decode($ligne_commandes['pokemon'], true);
    // Vérifier que la conversion a réussi
    if (json_last_error() === JSON_ERROR_NONE) {
        foreach($pokemon as $cle => $val){
            $pokedex[] = $cle;
        }
    }
    else{
        echo "ERREUR DE CONVERSION JSON";
    }
}
$pokedex = array_unique($pokedex);  // Enleve les doublons des id de pokemon
foreach($pokedex as $idPok){
    $sql = "SELECT p.nom as nom_pokemon, p.type_1, p.type_2, p.generation, p.légendaire, p.prix, p.discount, p.image, p.description
            FROM pokedex p WHERE p.id = :idPok";
    $requete = $bdd -> prepare($sql);
    $requete->bindParam(':idPok', $idPok, PDO::PARAM_INT);
    $requete->execute();
    // Récupérer le résultat
    $ligne_commandes = $requete->fetch(PDO::FETCH_ASSOC);
    echo '<div class="card">' .
         '<div class="card-img-top-container">' .
         '<img src="' . $ligne_commandes['image'] . '" alt="Image de ' . htmlspecialchars($ligne_commandes['nom_pokemon'], ENT_QUOTES) . '" class="card-img-top">' .
         '</div>' .
         '<div class="card-body">' .
         '<h5 class="card-title">' . htmlspecialchars($ligne_commandes['nom_pokemon'], ENT_QUOTES) . '</h5>' .
         '<p class="card-text">' .
         '<strong>Type principal:</strong> ' . htmlspecialchars($ligne_commandes['type_1'], ENT_QUOTES) .
         (empty($ligne_commandes['type_2']) ? '' : ', <strong>Type secondaire:</strong> ' . htmlspecialchars($ligne_commandes['type_2'], ENT_QUOTES)) .
         '<br><strong>Génération:</strong> ' . htmlspecialchars($ligne_commandes['generation'], ENT_QUOTES) .
         '<br><strong>Légendaire:</strong> ' . ($ligne_commandes['légendaire'] ? 'Oui' : 'Non') .
         '<br><strong>Description:</strong> ' . $ligne_commandes['description'] .  // J'ai enlevé htmlspecialchars() car ca enlevait les caractères spéciaux
         '</p>' .
         '</div>' .
         '</div>';
}
// Parcourir chaque ligne retournée par la requête
// while ($ligne_commandes = $requete->fetch(PDO::FETCH_ASSOC)) {
//     // Affichage des détails de chaque commande pour l'utilisateur connecté dans une seule div
//     echo '<div class="card">' .
//          '<div class="card-img-top-container">' .
//          '<img src="' . $ligne_commandes['image'] . '" alt="Image de ' . htmlspecialchars($ligne_commandes['nom_pokemon'], ENT_QUOTES) . '" class="card-img-top">' .
//          '</div>' .
//          '<div class="card-body">' .
//          '<h5 class="card-title">' . htmlspecialchars($ligne_commandes['nom_pokemon'], ENT_QUOTES) . '</h5>' .
//          '<p class="card-text">' .
//          '<strong>Type principal:</strong> ' . htmlspecialchars($ligne_commandes['type_1'], ENT_QUOTES) .
//          (empty($ligne_commandes['type_2']) ? '' : ', <strong>Type secondaire:</strong> ' . htmlspecialchars($ligne_commandes['type_2'], ENT_QUOTES)) .
//          '<br><strong>Génération:</strong> ' . htmlspecialchars($ligne_commandes['generation'], ENT_QUOTES) .
//          '<br><strong>Légendaire:</strong> ' . ($ligne_commandes['légendaire'] ? 'Oui' : 'Non') .
//          '<br><strong>Description:</strong> ' . htmlspecialchars($ligne_commandes['description'], ENT_QUOTES) .
//          '</p>' .
//          '</div>' .
//          '</div>';
// }
?>
</body>
<style>

 
#pokemonName {
    position: absolute; 
    top: 0; 
    left: 50%; 
    transform: translateX(-50%); /* Centre le nom horizontalement par rapport à sa propre largeur */
    font-size: 60px; 
    margin-top: 20px; 
}


#pokemonDescription {
    font-size: 16px;
    margin: 10px 0; /* Espacement autour de la description */
    text-align: justify; /* Alignement du texte pour une lecture facile */
    max-width: 100%; /* Assure que le texte ne dépasse pas du conteneur */
}

.button-ajouter {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.button-ajouter:hover {
    background-color: #0056b3; /* Changement de couleur au survol */
}

/* Responsivité */
@media (max-width: 768px) {
    .popup-flex-container {
        flex-direction: column;
        align-items: center;
    }

    .popup-content {
        width: 80%; /* Largeur plus grande pour les petits écrans */
    }
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

  /* Style pour le conteneur des cartes */
  .cards-container {
    display: flex;
    flex-wrap: wrap; /* Permet aux éléments de passer à la ligne suivante si nécessaire */
    justify-content: space-around; /* Répartit uniformément les cartes avec de l'espace autour d'elles */
    align-items: flex-start; /* Alignement au début pour gérer la hauteur variable des cartes */
    margin: 20px auto; /* Espacement vertical et centrage horizontal */
    max-width: 1100px; /* Largeur maximale pour le conteneur global */
    padding: 20px;
    gap: 20px;
}

.card {
    flex: 1 1 30%; /* Flexibilité, croissance et base des cartes */
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    margin: 10px; /* Espacement entre les cartes */
    max-width: 50%; /* Largeur maximale pour chaque carte */
    transition: box-shadow 0.3s;
    overflow: hidden;
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.2s ease-in-out;
}

@media (max-width: 991px) {
  .card {
    flex-basis: 48%; /* Sur les tablettes, deux cartes par ligne */
    max-width: 48%;
  }
}

@media (max-width: 767px) {
  .card {
    flex-basis: 100%; 
    max-width: 100%;
  }
}


.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.card-img-top {
    width: 350%;
    height: 100%;
    object-fit: cover;
}

.card-body {
    padding: 50px; 
    background: white;
}

.card-title {
    font-size: 30px; 
    color: #333;
    margin-bottom: 10px;
}

.card-text {
    font-size: 16px; 
    color: #666;
}

.type-label {
    display: inline-block;
    padding: 3px 10px; 
    margin-right: 5px;
    border-radius: 5px;
    color: #fff;
    background-color: #77aaff; 
}



</style>


</html>


