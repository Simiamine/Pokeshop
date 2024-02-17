<?php

//Code pour se connecter a la base de donnee SQL sur Hostinger
require_once 'pdoconfig.php';
try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);  //Base de donnee SQL
    // Définir les options PDO pour afficher les erreurs SQL
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connecté sur : $dbname à : $host réussie !<br>";  //On montre a l'ecran que ca a bien fonctionne

} 
catch (PDOException $pe) {
    die ("Erreur de connexion $dbname :" . $pe->getMessage());  //Erreur si la connexion a la bdd a echoue
    
}

?> 