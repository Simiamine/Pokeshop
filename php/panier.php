<?php
session_start();
include '../include/databaseconnect.php'; // Pour se connecter a la bdd

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
if (isset($_POST['update_qty'], $_POST['index'], $_POST['new_qty'] )) {
    $index = $_POST['index'];
    $new_qty = $_POST['new_qty'];
    $_SESSION['panier'][$index]->quantite = $new_qty;
    exit();
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

    // Fonction pour mettre a jour le panier et tout...
    function majPanier(element){
        var index = $(element).data('index');
        var id = $(element).data('idpok');
        var nom = $(element).data('nom');
        var newQty = parseInt($(element).val());
        var minValue = parseInt(($(element).attr('min')));
        var maxValue = parseInt($(element).attr('max'));
        //console.log(newQty + " min:" + minValue + "max:" + maxValue);
        if(newQty > maxValue){
            alert("Malheureusement, il n'y a pas assez de " + nom +".");
            $(element).val(1);  // On remet l'article a 1
            $.post('panier.php', { update_qty: true, index: index, new_qty: 1 }, function() {
                // Mettre à jour la quantité et recalculer le total
                calculerTotalPanier();
            });
        }
        else if(newQty <= 0){
            alert("Veuillez rentrer un chiffre valide.");
            $(element).val(1);  // On remet l'article a 1
            $.post('panier.php', { update_qty: true, index: index, new_qty: 1 }, function() {
                // Mettre à jour la quantité et recalculer le total
                calculerTotalPanier();
            });
        }
        else{
            // La fonction a Dines pour mettre a jour le panier session : 
            $.post('panier.php', { update_qty: true, index: index, new_qty: newQty }, function() {
                // Mettre à jour la quantité et recalculer le total
                calculerTotalPanier();
            });
        }
    }
    $(document).ready(function() {  
        // Mettre à jour le total lors du chargement de la page
        calculerTotalPanier();
    });
    </script>
<body>
    <div class="container">
    <?php if (!isset($_SESSION['user_statut']) || $_SESSION['user_statut'] != 'client'): ?>
        <h1 class="titre">
        Pour profiter de notre avantage de fidélité, merci de vous connecter <u><a href="login.php" class="login.php">ici</a></u>
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
                <?php 
                    foreach ($_SESSION['panier'] as $index => $produit): 
                        // Recupération de la quantité max de chaque pokemon
                        $sql = "SELECT quantité FROM pokedex WHERE id = :id";
                        $stmt = $bdd->prepare($sql);
                        $stmt->bindParam(':id', $produit->pokemon_id, PDO::PARAM_INT);
                        $stmt->execute();
                        $quantiteMax = $stmt->fetchColumn();
                    ?>

                    <tr>
                        <td ><?php echo $produit->pokemon_id; ?></td>
                        <td><?php echo $produit->nom; ?></td>
                        <td><?php echo $produit->prixApresRemise; ?></td>
                        <td>
                            <form class="qtyForm">
                                <input data-nom="<?php echo $produit->nom; ?>" data-index="<?php echo $index; ?>" data-idpok=<?php echo $produit->pokemon_id; ?> onchange="majPanier(this)" type="number" name="new_qty" value="<?php echo $produit->quantite; ?>" min=1 max=<?php echo $quantiteMax;?>>
                                <!-- <input type="submit" name="update_qty" value="Mettre à jour"> -->
                            </form>
                        </td>
                        <td class="totalProduit"><?php echo intval($produit->prix) * intval($produit->quantite); ?></td>
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
                </tr>
            </tfoot>
        </table> 

        <div style="margin-left: 40%;margin-right: 25%;">
        <button  class="btn-submit" title="Passer commande" a href="../../php/client/valider_commande.php">Valider ma commande</button>
         </div>

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
    margin: 1em auto 2em auto;
    margin-left:auto;
    margin-right:auto;
    cursor: pointer;
    border-radius: 5px;
}

#total {
    font-weight: bold;
}

</style>