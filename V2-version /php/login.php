<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeshop login</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

    <section id="header">
        <div class="logo">
            <a href="#"><img src="../img/icon.png" alt="pokeball" class = "logo" width="50"></a>
        </div>
        
        <div>
        <ul id="navbar">
                <li><a  href="../index.php" id="menu">Menu</a></li>
                <li><a href="pokedex.php" id="type">Pokedex</a></li>
                <li><a href="avantage.php" id="abonnement">Avantages</a></li>
                <li><a href="#" id="contact">Contact</a></li>
                <li><a class="active" href="login.php" id="connexion">Connexion</a></li>
                <li><a id="panier"  href="#"> <i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
            </ul>
        </div>
    </section>

    <script src="../js/script.js"></script>

    <form class="login-form" action="verifUser.php" method="POST">
    <div id="connexion">
        <p id="connins">Se connecter</p>
        <label>Email</label><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <label>Mot de passe</label><br>
        <input id="mdp" type="password" name="mdp" placeholder="Mot de passe" required><br>
        <!-- Ajout d'un champ caché pour l'action -->
        <input type="hidden" name="action" value="connexion">
        <!-- Div concernant les parametres mdp -->
        <div id="param_mdp">
            <input type="checkbox" onclick="voirMDP()"> <br><!-- bouton pour montrer le mdp -->
            <p id="texte_mdp"> Voir le mot de passe </p>
            <p id="texte_mdp2"> <a href="mdp_perdu.php">Mot de passe oublié ?</a> </p>
        </div>
        <input type="submit" value="Se connecter"><br>
    </div>
</form>


    <form class="login-form">
        <div class="inscription">  <!-- Partie inscription -->
            <p id="connins"> S'inscrire </p>

            <label>Prénom</label><br>
            <input type="text" name ="prenom" placeholder="Prénom"/> <br>

            <label>Nom</label><br>
            <input type="text" name ="nom" placeholder="Nom"/> <br>

            <label>Email </label><br>
            <input type="email" name ="email" placeholder="Email" required/> <br>

            <label>Numéro de téléphone </label><br>
            <input type="tel" name ="telephone" placeholder="Numéro de téléphone" required/> <br>

            <label>Date de naissance </label><br>
            <input type="date" name ="dateNaiss" placeholder="Date de naissance" required/> <br>

            <label>Mot de Passe</label><br>
            <input id="mdp1" type="password" name ="mdp1" placeholder="Mot de passe" required/> <br>

            <!-- Div concernant les parametres mdp -->
            <div id="param_mdp1">
                <input type="checkbox" onclick="voirMDP1()"> <br><!-- bouton pour montrer le mdp -->
                <p id="texte_mdp"> Voir le mot de passe </p>
            </div>

            <label>Confirmer votre Mot de Passe</label><br>
            <input id="mdp2" type="password" name ="mdp2" placeholder="Confirmez le mot de passe" required/> <br>
            <div id="param_mdp2">
                <input type="checkbox" onclick="voirMDP2()"> <br><!-- bouton pour montrer le mdp -->
                <p id="texte_mdp"> Voir le mot de passe </p>
            </div>

            <p id="rep_inscription"> </p>
            <input type="button" name="inscription" value="S'inscrire" onclick="inscript()"/>
        </div>
    </form>
</body>
</html>

<script>
    $(document).ready(function() {
        var error = new URLSearchParams(window.location.search).get('error');
        if (error) {
            alert("Adresse email ou mot de passe incorrect.");
        }
    });
</script>
