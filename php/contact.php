<?php 
   // session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeshop</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contact.css">



</head>
<body>
<section id="header">
        <div class="logo">
            <a href="../index.php"><img src="../img/icon.png" alt="pokeball" class = "logo" width="50"></a>
        </div>

        <?php if (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'client'): ?>
        <ul id="navbar">
        <li>Bonjour, <?= htmlspecialchars($_SESSION['user_name']); ?></li>
        <li><a  href="../index.php" id="menu">Menu</a></li>
        <li><a href="php/pokedex.php" id="type">Pokedex</a></li>
        <li><a  href="avantage.php" id="abonnement">Avantages</a></li>
        <li><a  class="active" href="contact.php" id="contact">Contact</a></li>
        <li><a href="deconnexion.php" id="deconnexion">Déconnexion</a></li>
        <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
        </ul>

        <?php elseif (isset($_SESSION['user_statut']) && $_SESSION['user_statut'] == 'admin'): ?>
            <ul id="navbar">
          <li>Compte_Admin </li>
        <li><a href="index.php" id="menu">Menu</a></li>
        <li><a href="#" id="type">Analyse</a></li>
        <li><a  href="php/ajout_pok.php" id="abonnement"> Pokemons</a></li>
        <li><a href="#" id="contact">Commandes</a></li>
        <li><a href="php/deconnexion.php" id="deconnexion">Déconnexion</a></li>
            </ul>

        <?php else: ?>
            <ul id="navbar">
      <li><a  href="../index.php" id="menu">Menu</a></li>
      <li><a href="pokedex.php" id="type">Pokedex</a></li>
      <li><a  href="avantage.php" id="abonnement">Avantages</a></li>
      <li><a class="active" href="contact.php" id="contact">Contact</a></li>
      <li><a href="login.php" id="connexion">Connexion</a></li>
      <li><a id="panier" href="#"><i class="fa-solid fa-bag-shopping fa-xl"></i></a></li>
        </ul>

        

<?php endif; ?>
</section>


<section id="contact-form">
    <div class="container">
        <div class="formulaire">
        <form action="contact.php" method="post">
            <label for="name">Nom :</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="message">Message :</label><br>
            <textarea id="message" name="message" rows="4" required></textarea><br>
            <input type="submit" value="Envoyer">
        </form>
        </div>
    </div>
</section>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        ini_set("SMTP","smtp.gmail.com");
        ini_set("smtp_port","587");
        $name = strip_tags(trim($_POST["name"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
            echo "Veuillez corriger vos entrées.";
            exit;
        }

        $file = "demandes.txt"; 
        $entry = "Nom: $name\nEmail: $email\nMessage: $message\n\n";

        file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);

        $to = "meven.thomas@gmail.com"; 
        $subject = "Nouvelle demande de contact";
        $email_body = "Vous avez reçu une nouvelle demande de contact.\n\n".$entry;
        $headers = "From: $email";

        if (mail($to, $subject, $email_body, $headers)) {
            echo "Votre message a été envoyé.";
        } else {
            echo "Désolé, quelque chose s'est mal passé.";
        }
    }
?>
</section>
</body>
</html>

