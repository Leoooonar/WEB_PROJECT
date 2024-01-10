<?php
include("./database.php");
$db = new Database();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: userLogin.php');
    exit;
}

// Si la barre de recherche est remplie, donne les données entrées dans la barre
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $results = $db->searchByTitle($searchTerm); // Récupère les résultats de la recherche
    $result = count($results); // Mise à jour de $result avec le nombre de résultats trouvés
}
?>