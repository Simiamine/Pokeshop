<?php 
    session_start();
    require  '../include/databaseconnect.php';
   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <script src="../js/pokemon.js" defer></script>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pokedex.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    </head>

    <section id="header">
        <div class="logo">
            <a href="../index.php"><img src="../img/icon.png" alt="pokeball" class = "logo" width="50"></a>
        </div>

        <?php if (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'client'): ?>
        <ul id="navbar">
        <li>Bonjour, <?= htmlspecialchars($_SESSION['user_name']); ?></li>
        <li><a  href="../index.php" id="menu">Menu</a></li>
        <li><a href="#" id="type">Pokedex</a></li>
        <li><a  href="avantage.php" id="abonnement">Avantages</a></li>
        <li><a href="contact.php" id="contact">Contact</a></li>
        <li><a href="deconnexion.php" id="deconnexion">Déconnexion</a></li>
        <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
        </ul>

        <?php elseif (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'admin'): ?>
            <ul id="navbar">
          <li>Compte_Admin </li>
        <li><a href="../index.php" id="menu">Menu</a></li>
        <li><a href="#" id="type">Analyse</a></li>
        <li><a class="active" href="ajout_pok.php" id="abonnement"> Pokemons</a></li>
        <li><a href="#" id="contact">Commandes</a></li>
        <li><a href="php/deconnexion.php" id="deconnexion">Déconnexion</a></li>
            </ul>

        <?php else: ?>
            <ul id="navbar">
      <li><a  href="../index.php" id="menu">Menu</a></li>
      <li><a href="pokedex.php" id="type">Pokedex</a></li>
      <li><a href="avantage.php" id="abonnement">Avantages</a></li>
      <li><a href="contact.php" id="contact">Contact</a></li>
      <li><a href="login.php" id="connexion">Connexion</a></li>
      <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
        </ul>
<?php endif; ?>
    </section>
    <main class="col overflow-auto h-100 w-100">
                <a class="btn btn-dark btn-sm" href="ajout_pok.php">← Retour</a><br><br>

                <?php
              // Vérification si le formulaire a été soumis
if (isset($_POST['ajouter'])) {
    // Récupération des valeurs du formulaire
    $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $type_1 = htmlentities($_POST['type_1'], ENT_QUOTES, 'UTF-8');
    $type_2 = htmlentities($_POST['type_2'], ENT_QUOTES, 'UTF-8');
    $generation = $_POST['generation'];
    $légendaire = isset($_POST['légendaire']) ? 1 : 0; // Convertit en 1 si coché, 0 sinon
    $prix = $_POST['prix'];
    $discount = $_POST['discount'];
    $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
    $quantite = $_POST['quantite'];
    // Assignation d'une image par défaut pour le produit
    $filename = 'pokeball.png';

    // Vérification si une image a été téléchargée
    if (!empty($_FILES['image']['name'])) {
        // Génération d'un nom unique pour l'image et ajout de l'extension de l'image
        $image = $_FILES['image']['name'];
        $filename = '../img/'.uniqid() . $image;
    }

                    // Vérification si les champs obligatoires ont été remplis
                    if (!empty($nom) && !empty($type_1)  && !empty($prix) && !empty($description)) {
                        $sqlState = $bdd->prepare('INSERT INTO Pokedex VALUES (null,?,?,?,?,?,?,?,?,?,?)');
                        $inserted = $sqlState->execute([$nom, $type_1, $type_2, $generation, $légendaire, $prix, $discount, $filename, $quantite, $description]);
                        
                        // Vérification si l'insertion a été réussie
                        if ($inserted) {
                            // Déplacement de l'image téléchargée dans le dossier de destination
                            move_uploaded_file($_FILES['image']['tmp_name'], '../img/' . $filename);

                            // Redirection vers la page des produits
                            header('location: ajout_pok.php');
                        } else {
                            // Affichage d'un message d'erreur si l'insertion a échoué
                            echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'insertion dans la base de donnée. Vérifiez que vous avez bien respecté les contraintes sur le format des informations.</div>';
                        }
                    } else {
                        // Affichage d'un message d'erreur si les champs obligatoires ne sont pas remplis
                        echo '<div class="alert alert-danger" role="alert">Des libellé sont obligatoire sont obligatoires.</div>';
                    }
                }
            ?>

<!--Début du formulaire pour ajouter un produit-->

            <form method="post" enctype="multipart/form-data">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom">

                <label class="form-label">Type 1 </label>
                <input type="text" class="form-control" name="type_1">

                <label class="form-label">Type 2</label>
                <input type="text" class="form-control" name="type_2">

                <label class="form-label">Generation</label>
                <input type="number" class="form-control" step="1" name="generation" min="0">

                <label class="form-label">Légendaire</label>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="légendaire" value="oui">
                    <label class="form-check-label" for="légendaire">
                        Oui
                    </label>
                </div>
                <label class="form-label">Prix</label>
                <input type="number" class="form-control" step="0.01" name="prix" min="0">

                <label class="form-label">Discount&nbsp&nbsp</label><output name="discountOutput" for="discount">0</output>%
                <input type="range" value="0" class="form-control" name="discount" min="0" max="90" oninput="discountOutput.value = discount.value">

                <label class="form-label">Description (255 caractères maximum)</label>
                <textarea class="form-control" name="description"></textarea>

                <label class="form-label">Quantité</label>
                <input type="number" class="form-control" name="quantite" min="0" required="required"></input>

                <label class="form-label">Image</label>
                <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" name="image">

                <input type="submit" value="Ajouter produit" class="btn btn-primary my-2" name="ajouter">
                </form>

                