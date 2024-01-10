<?php   
session_start();
include("./database.php");
$db = new Database();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: userLogin.php');
    exit;
}

// Supprime utilisateur (il faut déjà être connecté)
$db->deleteUser($_GET["id"]);
session_destroy();
?>

<p>la supression a été effectué avec succès !</p>
<br>
<a href="index.php">Retour à la page d'accueil</a>