<?
// Vérifier si un critère de tri a été spécifié
if (isset($_GET['tri'])) {
    $tri = $_GET['tri'];
    // Assurez-vous que le critère de tri est valide pour éviter les injections SQL
    $colonnesValides = ['nom', 'type_1', 'type_2', 'generation'];
    if (in_array($tri, $colonnesValides)) {
        $requete = $bdd->query("SELECT * FROM Pokedex ORDER BY $tri ASC");
    } else {
        // Critère de tri non valide, requête par défaut
        $requete = $bdd->query("SELECT * FROM Pokedex");
    }
} else {
    // Pas de critère de tri spécifié, requête par défaut
    $requete = $bdd->query("SELECT * FROM Pokedex");
}
?>