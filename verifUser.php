<?php
//include la fonction databaseconnect.php
include 'databaseconnect.php';

function test(string $prenom, string $nom, string $email, string $tel, string $dateNaiss, string $mdp1, string $mdp2 , array $erreur){
    // Fonction qui vérifie toute les données en fonction de chaques conditions
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$prenom)) {  // Vérifie que le prénom est bien composé de lettre seulement
        $erreur["prenom"] = -1;
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$nom)) {
        $erreur["nom"] = -1;
    }
    // Vérifie que chaque valeur ne sont pas vide
    if ($prenom === "") {
        $erreur["prenom"] = 0;
    }
  
    if ($nom === "") {
        $erreur["nom"] = 0;
    }
    
  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // Vérifie que l'email est au bon format
        $erreur["email"] = -1;
    }
    
    if(!preg_match('/^\d+$/', $tel)) {
        $erreur["telephone"] = -1;
    }
    if($tel === ""){
        $erreur["telephone"] = 0;
    }
    

    // DATE VERIFICATION
    // Créer un objet DateTime à partir de la chaîne en spécifiant le format
    $dateObj = DateTime::createFromFormat('d/m/Y', $dateNaiss);
    // Vérifier si l'objet DateTime a été créé avec succès
    if ($dateObj !== false && $dateObj->format('d/m/Y') === $dateNaiss) {
        $erreur["dateNaissance"] = 1;
    } else {
        $erreur["dateNaissance"] = -1;
    }

    if($dateNaiss === ""){  // Vérifier qu'une date à bien été mise
        $erreur["dateNaissance"] = 0;
    }
    // Mail 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // Vérifie que l'email est au bon format
        $erreur["email"] = -1;
    }
    if($email === ""){
        $erreur["email"] = 0;
    }
    // Sécurité du mot de passe 
    if ($mdp1 !== $mdp2) {  // Les mdp ne correspondent pas
        $erreur["mdp"] = -3;  // les mdp sont differents
    }
    if($mdp1 === ""){
        $erreur["mdp"] = 0;
    }
    if($mdp2 === ""){
        $erreur["mdp"] = -1;  // il faut que l'utilisateur verifie son mdp
    }
    
    if ($mdp1 === "" && $mdp2 === "") {
        $erreur["mdp"] = -4;  // il faut que l'utilisateur mette les mots de passe
    }
  
    
    
    /* Securisation du mot de passe
    if(strlen($mdp1) <= 7){
      echo '<div id="alert"> Pour plus de sécurité, <br> le mot de passe doit contenir au moins 8 caractères </div>';
      return 0;
    }
    if (!preg_match("/\d/", $mdp1)) {
      echo '<div id="alert"> Pour plus de sécurité, <br> le mot de passe doit contenir au moins 1 chiffre </div>';
      return 0;
    }
    if (!preg_match("/[A-Z]/", $mdp1)) {
      echo '<div id="alert"> Pour plus de sécurité, <br> le mot de passe doit contenir au moins 1 lettre majuscule </div>';
      return 0;
    }
    if (!preg_match("/[a-z]/", $mdp1)) {
      echo '<div id="alert"> Pour plus de sécurité, <br> le mot de passe doit contenir au moins 1 lettre minuscule </div>';
      return 0;
    }
    if (!preg_match("/\W/", $mdp1)) {
      echo '<div id="alert"> Pour plus de sécurité, <br> le mot de passe doit contenir au moins 1 caractère spécial </div>';
      return 0;
    } */
  
    return $erreur;
}

//Verifier l'unicite d'un mail
function mailUnique(PDO $pdo, string $mail){
    $sql = "SELECT COUNT(*) FROM utilisateur WHERE email = :Mail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':Mail', $mail, PDO::PARAM_STR);
    $stmt->execute();
          
    $compteur = $stmt->fetchColumn();  // (>0 : l'email existe déjà, =0 : l'email n'existe pas)
    if($compteur > 0){
        return 0;
    }
    return 1;
}

//Verifier qu'il n'y a aucune erreur dans la liste d'erreur
function checkErreur(array $erreur){
    foreach($erreur as $val){
        if($val != 1){
            return 0;
        }
    }
    return 1;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Si la requête est bien reçu
    // Vérifier si toutes les données a été envoyé   
    // INSCRIPTION
    if (isset($_POST["prenom"], $_POST["nom"], $_POST["email"], $_POST["tel"], $_POST["dateNaiss"], $_POST["mdp1"], $_POST["mdp2"])){
        // Récupération de toutes les données
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $mail = $_POST["email"];
        $tel = $_POST["tel"];
        $dateNaiss = $_POST["dateNaiss"];
        $mdp1 = $_POST["mdp1"];
        $mdp2 = $_POST["mdp2"]; 
        
        // Liste des erreurs sur les valeurs rentrees par l'utilisateur
        $erreur = array(  // 0 : il n'y a rien, 1 : c'est bon, autre : autre erreur
            'prenom' => 1,
            'nom' => 1,
            'email' => 1,
            'telephone' => 1,
            'dateNaissance' => 1,
            'mdp' => 1,
        );
        $erreur = test($prenom, $nom, $mail, $tel, $dateNaiss, $mdp1, $mdp2, $erreur);
        // Il faut si le mail est unique
        if(checkErreur($erreur)){
            if(!mailUnique($bdd, $mail)){
                $erreur["email"] = -2;
            }
            else{
                //Transformation du prénom et du nom au bon format
                $prenom = ucfirst(strtolower($prenom));
                $mail = strtolower($mail);
                $nom = strtoupper($nom);
        
                // Insertion des données dans la table
                $sql = "INSERT INTO utilisateur (prenom, nom, email, telephone, dateNaissance, mdp) VALUES (:prenom, :nom, :mail, :telephone, :dateNaissance, :mdp)";
        
                // Préparer la requête
                $stmt = $bdd->prepare($sql);
                
                $mdp1 = password_hash($_POST["mdp1"],PASSWORD_DEFAULT);  //On crypte le mdp
        
                // Binder les valeurs aux paramètres de la requête
                $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
                $stmt->bindParam(':telephone', $tel, PDO::PARAM_STR);
                $stmt->bindParam(':dateNaissance', $dateNaiss, PDO::PARAM_STR);
                $stmt->bindParam(':mdp', $mdp1, PDO::PARAM_STR);
        
                // Exécuter la requête
                $stmt->execute();
            }
        }
        header('Content-Type: application/json');
        $json = json_encode($erreur);
        echo $json;
        $bdd = null; // Fermer la connexion PDO
    }

    // CONNEXION
}

?>