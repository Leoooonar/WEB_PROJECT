<?php
include("./database.php");
$db = new Database();

// Si la barre de recherche est remplie, donne les données entrées dans la barre
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $results = $db->searchByTitle($searchTerm); // Récupère les résultats de la recherche
    $result = count($results); // Mise à jour de $result avec le nombre de résultats trouvés
}
?>