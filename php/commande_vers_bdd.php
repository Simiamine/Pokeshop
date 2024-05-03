<?php
session_start();
// Vérifier si le formulaire a été soumis


include '../include/databaseconnect.php'; 


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresseLivraison = $_POST['adresse'];
    $ville = $_POST['ville'];
    $paymentMethod = $_POST['payment_method'];
    $codePostal = $_POST['code_postal'];
    // Récupérer les données de la session
    $idUtilisateur = $_SESSION['user_id']; // Assurez-vous que cette variable est bien initialisée dans la session
    $livraison = $_POST['livraison'];; // Points avantages toujours de 100
    $total = $_SESSION['finalPrice']; // Calcul du total du panier
    $numeroCommande = uniqid(); // Génération d'un identifiant unique pour la commande

    // Préparer la requête SQL
    $query = "INSERT INTO commandes (id_utilisateur, adresse_livraison, ville, code_postal, livraison, total, numero_commande, date_creation)
              VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

    if ($stmt = $bdd->prepare($query)) {
        // Lier les variables aux paramètres de la requête préparée
         // Lier les variables aux paramètres de la requête préparée
        $stmt->bindValue(1, $idUtilisateur, PDO::PARAM_INT);
        $stmt->bindValue(2, $adresseLivraison, PDO::PARAM_STR);
        $stmt->bindValue(3, $ville, PDO::PARAM_STR);
        $stmt->bindValue(4, $codePostal, PDO::PARAM_INT);
        $stmt->bindValue(5, $livraison, PDO::PARAM_INT);
        $stmt->bindValue(6, $total, PDO::PARAM_INT); 
        $stmt->bindValue(7, $numeroCommande, PDO::PARAM_STR);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Commande enregistrée avec succès!";
        } else {
            echo "Erreur : " . $stmt->error;
        }



        // Fermer le statement
        $stmt=null;



        // Préparer la requête SQL pour insérer les détails de la commande
        $query = "INSERT INTO ligne_commandes (id_commande, id_pokemon, quantite) VALUES (?, ?, ?)";
        $stmt = $bdd->prepare($query);
    
        // Parcourir chaque article du panier pour enregistrer les détails
        foreach ($_SESSION['panier'] as $key=>$produit) {
            $idPokemon = $produit->pokemon_id;
            $quantite = $produit->quantite;
    
            // Lier les variables et exécuter la requête
            $stmt->bindValue(1, $numeroCommande, PDO::PARAM_STR);
            $stmt->bindValue(2, $idPokemon, PDO::PARAM_INT);
            $stmt->bindValue(3, $quantite, PDO::PARAM_INT);
            $stmt->execute();
        }
    
        // Vérifier si les insertions ont réussi
        if ($stmt->rowCount() > 0) {
            echo "Détails de la commande enregistrés avec succès!";
        } else {
            echo "Erreur : " . $stmt->errorInfo()[2];
        }
    
        // Nettoyer le statement
        $stmt = null;
    
        // Fermer la connexion
        $pdo = null;
    } else {
        echo "Erreur : " . $bdd->error;
    }

    // Fermer la connexion
    $bdd=null;
    $_SESSION['panier'] = array();
    header("Location: ./ecran_de_validation.php");
    
} else {
    // Rediriger l'utilisateur si le formulaire n'est pas soumis par POST
    header("Location: ./client/valider_commande.php"); // Modifiez avec la page de votre formulaire
    exit();
}
?>