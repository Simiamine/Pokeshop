<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeshop login</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="../js/scriptLogin.js"></script>
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
	<div class="form-modal">
    
    <div class="form-toggle">
        <button id="login-toggle" onclick="toggleLogin()">Connexion</button>
        <button id="signup-toggle" onclick="toggleSignup()">Inscription</button>
    </div>

    <div id="mdp-form">
        <form>
			<input id="emailMdp" type="email" name="email" placeholder="Email" maxlength="50" required><br>
			<div id="rep_emailMdp"> </div>
            <button type="button" class="btn btn_mdp" onclick="mailMdp()">Récuperer le mot de passe</button>
            <hr/>
        </form>
    </div>

    <div id="login-form">
        <form>
			<input id="emailc" type="email" name="email" placeholder="Email" maxlength="50" required><br>
            <div class="champMdp">
                <input id="mdp" type="password" name="mdp" placeholder="Mot de passe" maxlength="50" required><br>
                <i id="boutonMdp" class="fa-regular fa-eye-slash" onclick="voirMDP()"></i>
            </div>
			<div id="rep_connexion"> </div>
            <button type="button" class="btn login" onclick="connex()">Connexion</button>
            <p><a href="javascript:toggleMdp();">Mot de passe oublié ?</a></p>
            <hr/>
        </form>
    </div>

    <div id="signup-form">
        <form>
			<input id="prenom" type="text" name ="prenom" placeholder="Prénom" maxlength="50" required/> <br>
            <input id="nom" type="text" name ="nom" placeholder="Nom" maxlength="50" required/> <br>
			<input id="email" type="email" name ="email" placeholder="Adresse mail" maxlength="50" required/> <br>
			<input id="tel" type="tel" name ="telephone" placeholder="Numéro de téléphone" maxlength="30" required/> <br>
			<input id="dateNaiss" type="date" name ="dateNaiss" placeholder="Date de naissance" required/> <br>
            <div class="champMdp">
                <input class="champMdpInput" id="mdp1" type="password" name ="mdp1" placeholder="Nouveau mot de passe" maxlength="50" required/> <br> 
                <!--<input class="champMdpBouton" type="checkbox" onclick="voirMDP1()"> <br> bouton pour montrer le mdp -->
                <i id="boutonMdp1" class="fa-regular fa-eye-slash" onclick="voirMDP1()"></i>
            </div>
            <div class="champMdp">
                <input class="champMdpInput" id="mdp2" type="password" name ="mdp2" placeholder="Confirmez le mot de passe" maxlength="50" required/> <br>
                <i id="boutonMdp2" class="fa-regular fa-eye-slash" onclick="voirMDP2()"></i>
            </div>
			<div id="rep_inscription"> </div>
            <button type="button" class="btn signup" onclick="inscript()">S'inscrire</button>
            <p>En cliquant sur le bouton, vous acceptez notre <a href="javascript:void(0)">politique de confidentialité</a>.</p>
            <hr/>
           
        </form>
    </div>

</div>

</body>
</html>