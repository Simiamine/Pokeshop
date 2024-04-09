<?php
session_start();

// Initialiser le panier s'il n'existe pas encore
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier | Pokeshop</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <!-- j'ai modifié -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/valider_commande.css">
    <link rel="icon" type="image/png" href="../img/icon.png"/>
</head>


<?php include_once('../../include/header.php'); ?>
<script>
    $("#panier").addClass("active");  // Fonction pour mettre la class "active" en fonction de la page
</script>

<div class="form-modal">
<div id="commande">
        <form>
			<input id="prenom" type="text" name ="prenom" placeholder="Prénom" maxlength="50" required/> <br>
            <input id="nom" type="text" name ="nom" placeholder="Nom" maxlength="50" required/> <br>
			<input id="email" type="email" name ="email" placeholder="Adresse mail" maxlength="50" required/> <br>
			<input id="tel" type="tel" name ="telephone" placeholder="Numéro de téléphone" maxlength="30" required/>
        </form>
    </div>
</div>