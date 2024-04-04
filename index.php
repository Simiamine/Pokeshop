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
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/icon.png"/>
</head>

<?php include_once('include/header.php'); ?>
<script>
    $("#menu").addClass("active");  // Fonction pour mettre la class "active" en fonction de la page
</script>

<body>
    

    <section id="hero">
        <h2>Achetez votre propre</h2>
        <h1>Pokémon !</h1>
        <button>Achetez dès maintenant !</button>
    </section>

      </div>
    </nav>

</body>
<?php include_once('include/footer.php'); ?>
</html>
