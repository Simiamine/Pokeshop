<?php 
   session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeshop</title>
    <script src="https://kit.fontawesome.com/d6a49ddf6e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/contact.css">



</head>
<body>
<?php include_once('../include/header.php'); ?>
    <script>
        $("#contact").addClass("active");  // Fonction pour mettre la class "active" en fonction de la page
    </script>


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
<?php include_once('../include/footer.php'); ?>
</html>

