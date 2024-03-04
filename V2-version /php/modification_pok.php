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

                 <!-- Affichage d'un titre de niveau 4 -->
                 <h4>Modifier Pokemon</h4>

                 <?php
                    // Récupération de l'identifiant du pokemon à modifier depuis l'URL
                    $id = $_GET['id'];

                    // Préparation d'une requête SQL pour obtenir les détails du pokemon à modifier
                    $sqlState = $bdd->prepare('SELECT * from Pokedex WHERE id=?');
                    $sqlState->execute([$id]);

                    // Récupération des détails du pokemon
                    $pokedex = $sqlState->fetch(PDO::FETCH_OBJ);


                    // Vérification si le formulaire de modification a été soumis
                    if (isset($_POST['modifier'])) {
                        // Récupération des nouvelles valeurs des champs du formulaire
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

                        $filename = '';
                        // Vérification si une nouvelle image a été téléchargée
                        if (!empty($_FILES['image']['name'])) {
                            $image = $_FILES['image']['name'];
                            $filename = uniqid() . $image;
                            // Déplacement de l'image téléchargée vers le dossier 'data'
                            move_uploaded_file($_FILES['image']['tmp_name'], '../../data' . $filename);
                        }

                         // Vérification si les champs obligatoires ont été remplis
                    if (!empty($nom) && !empty($type_1)  && !empty($prix) && !empty($description)) {
                         // Préparation de la requête SQL pour mettre à jour les détails du produit
                         if (!empty($filename)) {
                            $query="UPDATE Pokedex SET nom=?, type_1=?, type_2=?, generation=?, légendaire=?, prix=?, discount=?, description=?, quantite=?, image=? WHERE id = ?";
                            $sqlState = $bdd->prepare($query);
                            $updated= $sqlState->execute([ $nom, $type_1, $type_2, $generation, $légendaire, $prix, $discount, $description, $quantite, $filename, $id]);
                         }else{
                            $query= "UPDATE Pokedex SET nom=?, type_1=?, type_2=?, generation=?, légendaire=?, prix=?, discount=?, description=?, quantite=?  WHERE id = ?";
                            $sqlState = $bdd->prepare($query);
                            $updated= $sqlState->execute([ $nom, $type_1, $type_2, $generation, $légendaire, $prix, $discount, $description, $quantite, $id]);

                            if ($updated) {
                                header('location: ajout_pok.php');
                            } else {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        Erreur lors de l'insertion dans la base de donnée. Vérifiez que vous avez bien respecté les contraintes sur le format des informations.
                                    </div>
                                    <?php
                                }
                        } 
                        }
                    }?>
