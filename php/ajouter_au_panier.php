<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

$data = json_decode(file_get_contents('php://input')); // Convertir les données JSON en objet PHP

if ($data) { // Vérifier si les données JSON ont été correctement décodées
    // Ajouter la propriété "quantite" avec une valeur initiale de 1 parceque conflit avec ce dernier pas toujours reconnu comme numérique 
    $data->quantite = 1;
    array_push($_SESSION['panier'], $data); // Ajouter l'objet au panier

    // Afficher les propriétés de l'objet
    echo "Produit ajouté au panier avec succès : ";
    echo "Nom : " . $data->nom . ", ";
    echo "Prix : " . $data->prix . ", ";
    echo "Prix après remise : " . $data->prixApresRemise;
} else {
    echo "Erreur : les données du produit ne sont pas valides.";
}

?>
