<?php   
session_start();
include("./database.php");
$db = new Database();
$deleteTeacher = $db->deleteUser($_GET["id"]);
session_destroy();
?>


<p>la supression a été effectué avec succès !</p>
<br>
<a href="index.php">Retour à la page d'accueil</a>