<?php
session_start();
include("./database.php");

$db = new Database();

// Vérifie si l'utilisateur est connecté et a les droits nécessaires
if (!isset($_SESSION['user'])) {
    die("Vous devez être connecté pour effectuer cette action.");
}

// Garde l'id de l'utilisateur pour l'utiliser pour tester si le livre appartient au bon user
$userId = $_SESSION['user']['user_id'];

// Vérifie si l'ID du livre est défini
if (isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];

    // Récupère les informations du livre pour vérifier si l'utilisateur actuel est autorisé à le supprimer
    $book = $db->getBookById($bookId);

    if ($book && $book['user_fk'] == $userId) {
        // L'utilisateur actuel a posté ce livre, procède à la suppression
        $db->deleteBook($bookId);
        echo "Le livre a été supprimé avec succès.";
    } else {
        die("Vous n'avez pas l'autorisation de supprimer ce livre.");
    }
} else {
    die("Aucun identifiant de livre spécifié.");
}

// Redirige vers une autre page après la suppression
header('Location: userBooks.php');
exit();
?>