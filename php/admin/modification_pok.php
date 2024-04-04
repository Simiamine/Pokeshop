<?php 
    session_start();
    require  '../../include/databaseconnect.php';
    if (!isset($_SESSION['user_statut']) || $_SESSION['user_statut'] != "admin") {
        header('Location: ../../index.php');
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier Pokemon | Pokeshop</title>
        <script src="../js/pokemon.js" defer></script>
        <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/pokedex.css">
        <link rel="stylesheet" href="../../css/bootstrap.css">
        <link rel="icon" type="image/png" href="../../img/icon.png"/>
    </head>

    <section id="header">
        <div class="logo">
            <a href="../index.php"><img src="../img/icon.png" alt="pokeball" class = "logo" width="50"></a>
        </div>

    
        <?php if (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'admin'): ?>
            <ul id="navbar">
          <li>Compte_Admin </li>
        <li><a href="../../index.php" id="menu">Menu</a></li>
        <li><a href="#" id="type">Analyse</a></li>
        <li><a class="active" href="ajout_pok.php" id="abonnement"> Pokemons</a></li>
        <li><a href="#" id="contact">Commandes</a></li>
        <li><a href="php/deconnexion.php" id="deconnexion">Déconnexion</a></li>
            </ul>
<?php endif; ?>
    </section>
    <main class="col overflow-auto h-100 w-100">
                <a class="btn btn-dark btn-sm" href="ajout_pok.php">← Retour</a><br><br>

                 <!-- Affichage d'un titre de niveau 4 -->
                 <h4>Modifier Pokemon</h4>

                 <?php
                   // Vérification de l'existence de l'ID dans l'URL
                    if (!isset($_GET['id'])) {
                        echo "ID du Pokémon non spécifié.";
                        exit; // Arrête l'exécution du script si l'ID n'est pas présent.
                    }
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
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($pokedex->id) ?>">

    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($pokedex->nom) ?>" required><br>

    <label for="type_1">Type 1:</label>
    <input type="text" id="type_1" name="type_1" value="<?= htmlspecialchars($pokedex->type_1) ?>" required><br>

    <label for="type_2">Type 2 (laisser vide si aucun):</label>
    <input type="text" id="type_2" name="type_2" value="<?= htmlspecialchars($pokedex->type_2) ?>"><br>

    <label for="generation">Génération:</label>
    <input type="number" id="generation" name="generation" value="<?= htmlspecialchars($pokedex->generation) ?>" required><br>

    <label for="legendaire">Légendaire:</label>
    <input type="checkbox" id="legendaire" name="legendaire" <?= $pokedex->légendaire ? 'checked' : '' ?>><br>

    <label for="prix">Prix:</label>
    <input type="text" id="prix" name="prix" value="<?= htmlspecialchars($pokedex->prix) ?>" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?= htmlspecialchars($pokedex->description) ?></textarea><br>

    <label for="image">Image:</label>
    <input type="file" id="image" name="image"><br>

    <input type="submit" name="modifier" value="Modifier">
</form>
