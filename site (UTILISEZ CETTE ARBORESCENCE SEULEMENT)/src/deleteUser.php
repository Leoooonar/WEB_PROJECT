<?php   
session_start();
include("./database.php");
$db = new Database();
// Supprime utilisateur (il faut déjà être connecté)
$deleteTeacher = $db->deleteUser($_GET["id"]);
session_destroy();
?>


<p>la supression a été effectué avec succès !</p>
<br>
<a href="index.php">Retour à la page d'accueil</a>