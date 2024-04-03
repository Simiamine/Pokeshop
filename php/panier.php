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
    if ($new_qty > 0 && is_numeric($new_qty)) {
        $_SESSION['panier'][$index]->quantite = $new_qty;
    } else {
        // Supprimer le produit s'il y a une quantité invalide
        unset($_SESSION['panier'][$index]);
    }
    header("Location: panier.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeshop Panier</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <!-- j'ai modifié -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/panier.css">
</head>
<script>
            $(document).ready(function() {
             
            // Fonction pour calculer le total du panier en JavaScript
              function calculerTotalPanier() {
                let total = 0;
                $('#panierTable tbody tr').each(function() {
                    let prixUnitaire = parseFloat($(this).find('td:nth-child(2)').text());
                    let quantiteInput = $(this).find('input[name="new_qty"]');
                    let quantite = parseInt(quantiteInput.val());
                    if (!isNaN(quantite) && quantite > 0) { // Vérifier si la quantité est un nombre valide et supérieure à zéro
                        let totalProduit = prixUnitaire * quantite;
                        $(this).find('.totalProduit').text(totalProduit.toFixed(2));
                        total += totalProduit;
                    }
                });
                $('#total').text(total.toFixed(2));
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

    <section id="header">
        <div class="logo">
            <a href="#"><img src="../img/icon.png" alt="pokeball" class="logo" width="50"></a>
        </div>

        <div>
            <ul id="navbar">
                <li><a href="../index.php" id="menu">Menu</a></li>
                <li><a href="pokedex.php" id="type">Pokedex</a></li>
                <li><a href="avantage.php" id="abonnement">Avantages</a></li>
                <li><a href="#" id="contact">Contact</a></li>
                <li><a class="active" href="login.php" id="connexion">Connexion</a></li>
                <!-- Affichage du nombre d'articles dans la barre de navigation -->
                <li><a id="panier" href="panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo count($_SESSION['panier']); ?></span></a></li>

            </ul>
        </div>
    </section>

    <div class="container">
    <h1 class="titre">Panier</h1>
    <?php if(empty($_SESSION['panier'])): ?>
    <div class="panier-vide">
        <h1>Votre panier est vide.</h1>
    </div>
    <?php else:?>
    <div class="panier">
        <table id="panierTable">
            <thead>
                <tr>
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
                    <td colspan="2" id="total">0</td>
                </tr>
            </tfoot>
        </table>
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

#total {
    font-weight: bold;
}

</style>