<header>
<section id="header">
    <div class="logo">
        <a href="../index.php"><img src="../img/icon.png" alt="pokeball" class = "logo" width="50"></a>
    </div>
    <div>
        <ul id="navbar">
            <?php if (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'client'): ?>
            <li>Bonjour, <?= htmlspecialchars($_SESSION['user_name']); ?></li>
            
            <li><a href="../index.php" id="menu">Menu</a></li>
            <li><a href="../php/catalogue.php" id="catalogue">Catalogue</a></li>
            <li><a href="../php/pokedex.php" id="type">Pokedex</a></li>
            <li><a href="../php/client/compte_client.php" id="compte">Compte</a></li>
            <li><a href="../php/deconnexion.php" id="deconnexion">Déconnexion</a></li>
            <!-- j'ai modifié -->
            <li><a id="panier" href="../php/panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo isset($_SESSION['panier'])? count($_SESSION['panier']) : 0; ?></span></a></li> 


            <?php elseif (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'admin'): ?>
            <li>Compte_Admin </li>
            <li><a href="../index.php" id="menu">Menu</a></li>
            <li><a href="../php/admin/ajout_produit_pokemon.php" id="catalogue">Analyse</a></li>
            <li><a href="../php/admin/ajout_pok.php" id="pokemon"> Pokemons</a></li>
            <li><a href="#" id="contact">Commandes</a></li>
            <li><a href="../php/deconnexion.php" id="deconnexion">Déconnexion</a></li>

            <?php else: ?>
            <li><a href="../index.php" id="menu">Menu</a></li>
            <li><a href="../php/catalogue.php" id="catalogue">Catalogue</a></li>
            <li><a href="../php/avantage.php" id="avantage">Avantages</a></li>
            <li><a href="../php/contact.php" id="contact">Contact</a></li>
            <li><a href="../php/login.php" id="connexion">Connexion</a></li>
            <!-- j'ai modifié -->
            <li><a id="panier" href="../php/panier.php"> <i class="fa-solid fa-bag-shopping fa-xl"></i> <span id="panierCount"><?php echo isset($_SESSION['panier'])? count($_SESSION['panier']) : 0; ?></span></a></li>  

            <?php endif; ?>
        </ul>
    </div>
</section>
</header>