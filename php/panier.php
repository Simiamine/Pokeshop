<?php
session_start();

// Initialiser le panier s'il n'existe pas encore
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Supprimer un produit du panier
if (isset($_GET['supprimer']) && isset($_SESSION['panier'][$_GET['supprimer']])) {
    unset($_SESSION['panier'][$_GET['supprimer']]);
    header("Location: panier.php");
    exit();
}

// Mettre à jour la quantité d'un produit dans le panier
if (isset($_POST['update_qty'])) {
    $index = $_POST['index'];
    $new_qty = $_POST['new_qty'];

    // Vérifier si la nouvelle quantité est valide
    // la vérification se fait enft dans ajouter_au_panier.php mais je l'ai laissé ici au cas ou 
    if ($new_qty > 0 && is_numeric($new_qty)) {
        $_SESSION['panier'][$index]->quantite = $new_qty;
    } else {
        // Supprimer le produit s'il y a une quantité invalide
        unset($_SESSION['panier'][$index]);
    }
    header("Location: panier.php");
    exit();
}
// Vérifier si un code promotionnel a été soumis
if (isset($_POST['code_promo']) && $_POST['code_promo'] === 'POKE20') {
    // Appliquer une réduction de 20% sur le total
    foreach ($_SESSION['panier'] as $produit) {
        $produit->prixApresRemise = $produit->prixApresRemise * 0.8; // 20% de réduction
    }
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

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/panier.css">
    <link rel="icon" type="image/png" href="../img/icon.png"/>
</head>
<?php include_once('../include/header.php'); ?>
<script>
    $("#panier").addClass("active");  // Fonction pour mettre la class "active" en fonction de la page
</script>
<script>
            $(document).ready(function() {
             
        function calculerTotalPanier() {
            let total = 0;
            $('#panierTable tbody tr').each(function() {
                let prixUnitaire = parseFloat($(this).find('td:nth-child(3)').text());
                let quantiteInput = $(this).find('input[name="new_qty"]');
                let quantite = parseInt(quantiteInput.val());
                if (!isNaN(quantite) && quantite > 0) {
                    let totalProduit = prixUnitaire * quantite;
                    $(this).find('.totalProduit').text(totalProduit.toFixed(2));
                    total += totalProduit;
                }
            });
            // Mettre à jour la cellule de total global
            $('.totalGlobal').text(total.toFixed(2));
        }


            // Mettre à jour le total lors du chargement de la page
            calculerTotalPanier();

            // Écouter les soumissions du formulaire de quantité et recalculer le total
            $('#panierTable').on('submit', '.qtyForm', function(e) {
                e.preventDefault();
                let index = $(this).data('index');
                let newQty = $(this).find('input[name="new_qty"]').val();
                $.post('panier.php', { update_qty: true, index: index, new_qty: newQty }, function() {
                    // Mettre à jour la quantité et recalculer le total
                    calculerTotalPanier();
                });
            });
        });
    </script>
<body>
    <div class="container">
    <?php if (!isset($_SESSION['user_statut']) || $_SESSION['user_statut'] != 'client'): ?>
        <h1 class="titre">
        Pour profiter de notre avantage de fidélité, merci de vous connecter <a href="login.php" class="login.php">ici</a>
        </h1>
    <?php else: ?>
        <h1 class="titre">Panier</h1>
    <?php endif; ?>
    <?php if(empty($_SESSION['panier'])): ?>
    <div class="panier-vide">
        <h2>Votre panier est vide.</h2>
    </div>
    <?php else:?>
    <div class="panier">
        <table id="panierTable">
            <thead>
                <tr>
                    <th>ID du Pokémon</th>
                    <th>Nom du produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['panier'] as $index => $produit): ?>
                    <tr>
                        <td><?php echo $produit->pokemon_id; ?></td>
                        <td><?php echo $produit->nom; ?></td>
                        <td><?php echo $produit->prixApresRemise; ?></td>
                        <td>
                            <form class="qtyForm" data-index="<?php echo $index; ?>">
                                <input type="number" name="new_qty" value="<?php echo $produit->quantite; ?>" min="1">
                                <input type="submit" name="update_qty" value="Mettre à jour">
                            </form>
                        </td>
                        <td class="totalProduit"><?php echo $produit->prix * $produit->quantite; ?></td>
                        <td>
                            <form action="panier.php" method="GET">
                                <input type="hidden" name="supprimer" value="<?php echo $index; ?>">
                                <button type="submit" class="btn-delete" title="Supprimer"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2" id="total" class="totalGlobal">0</td>
                    <td>
                    <form action="vider_panier.php" method="POST">
                    <button type="submit" class="btn btn-danger">Vider le panier</button>
                    </form>
            </td>
                </tr>
            </tfoot>
        </table> 
        <!--
        <form action="../../php/client/valider_commande.php" method="POST" class="commande-form">
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="adresse">Adresse de facturation :</label>
        <textarea id="adresse" name="adresse" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="code_postal">Code postal :</label>
        <input type="text" id="code_postal" name="code_postal" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="type_livraison">Type de livraison :</label>
        <select id="type_livraison" name="type_livraison" class="form-control" required>
            <option value="standard">Standard</option>
            <option value="express">Express</option>
        </select>
    </div> -->
    <div class="form-group" style="display: inline-block; margin-right: 10px;">
        <label for="code_promo">Code de promotion :</label>
        <input type="text" id="code_promo" name="code_promo">
    </div>
    <button type="submit" style="background-color: blue;" class="btn btn-primary">Appliquer le code</button>

    <div style="margin-left: 25%; margin-right: 25%;">
        <button class="btn-submit" title="Passer commande" a href="client/valider_commande.php">Valider ma commande</button>
    </div>
</form>

    </div> 
    <?php endif; ?>
</div>
</body>

</html>

<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat|Quicksand');

*{
    font-family: 'quicksand',Arial, Helvetica, sans-serif;
    box-sizing: border-box;
}

body{
    background:#fff;
}

.container {
    width: 80%;
    margin: 0 auto;
}

.titre{
    text-align: center;
    padding-top: 10px;
    padding-bottom: 10px;
    font-size: 1.5rem !important;
}

.panier-vide {
    text-align: center;
    margin-top: 20px;
}

.panier {
    margin-top: 20px;
}

#panierTable {
    width: 100%;
    border-collapse: collapse;
}

#panierTable th, #panierTable td {
    border: 1px solid #ddd;
    padding: 8px;
}

#panierTable th {
    background-color: #f2f2f2;
    text-align: left;
}

#panierTable tr:nth-child(even) {
    background-color: #f2f2f2;
}

#panierTable tr:hover {
    background-color: #ddd;
}

#panierTable td {
    text-align: center;
}

.qtyForm input[type="number"] {
    width: 50px;
}

.qtyForm input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-delete {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-submit {
    background-color: #52f436;
    color: black;
    border: none;
    padding: 15px 30px;
    text-align: center;
    text-decoration: none;
    
    font-size: 14px;
    margin: auto 2em auto;
    margin-left:auto;
    margin-right:auto;
    margin-bottom:35px;
    cursor: pointer;
    border-radius: 5px;
}

.btn-submit_2{
    background-color: #52f436;
    color: black;
    border: none;
    padding: 15px 30px;
    text-align: center;
    text-decoration: none;
    
    font-size: 14px;
    margin: auto 2em auto;
    margin-left:auto;
    margin-right:auto;
    cursor: pointer;
    border-radius: 5px;
}
#total {
    font-weight: bold;
}
.commande-form {
    margin-top: 20px;
}

.commande-form .form-group {
    margin-bottom: 20px;
}

.commande-form label {
    font-weight: bold;
}

.commande-form input[type="text"],
.commande-form textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.commande-form button {
    background-color: #52f436;
    color: black;
    border: none;
    padding: 15px 30px;
    text-align: center;
    text-decoration: none;
    font-size: 14px;
    margin: em auto 2em auto;
    display: block;
    cursor: pointer;
    border-radius: 5px;
}

</style>