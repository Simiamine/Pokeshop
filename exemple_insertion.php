<?php

//include la fonction databaseconnect.php 
// Cette ligne doit etre importe dans tout les codes qui recquiert une requete sql
include 'databaseconnect.php';

// Preparation de la requete SQL
$sql = "INSERT INTO pokedex (nom, type_1, type_2, id_stat, description, quantite) VALUES (:nom, :type1, :type2, :id_stat, :descr, :quanti );";

// Preparation des valeurs
$stmt = $bdd -> prepare($sql);  
$val1 = "Bulbizarre";
$val2 = "Plante";
$val3 = "Eau";
$val4 = 158;
$val5 = "Un pokemon test";
$val6 = 6548544;


$stmt->bindParam(':nom', $val1, PDO::PARAM_STR);
$stmt->bindParam(':type1', $val2, PDO::PARAM_STR);
$stmt->bindParam(':type2', $val3, PDO::PARAM_STR);
$stmt->bindParam(':id_stat', $val4, PDO::PARAM_INT);
$stmt->bindParam(':descr', $val5, PDO::PARAM_STR);
$stmt->bindParam(':quanti', $val6, PDO::PARAM_INT);

// Exécution de la requête
$stmt -> execute();  

echo "Ca a fonctionné !";


?>