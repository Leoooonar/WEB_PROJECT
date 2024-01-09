<?php
session_start();

include("./database.php");
$db = new Database();

$idBook = $_GET["idBook"];

//Remplacer array par Database ou équivalent quand l'objet sera créé
$dataB = array();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!--
        Auteur: Yann Mangiagli
        Date:   05.12.23
        Modif:  12.12.23
        Desc:   Page permettant à un utilisateur de consulter les
                informations d'un livre depuis la db. (couverture, titre
                auteur, nb appréciations, moyenne d'appréciations)
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/styleLeo.css">
    <title>Informations</title>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li class="nav-item">ACCUEIL</li>
            <li class="nav-item">LIVRES</li>
            <li class="nav-logo"><img src="./MEDIA/logoRR.png" alt="Readers Realm logo"></li>
            <li class="nav-item">CONTACT</li>
            <li class="nav-item">CONNEXION</li>
        </ul>
    </nav>
    <div class="mainContainer">
        <?php
        //Création du tableau html qui va entrer les infos 
        $tableTxt = "";
        $tableTxt .= "<table>";
        $tableTxt .= "<tr>";
        $tableTxt .= "<td>Image</td>";
        //dataB est un placeholder, il faudra mettre le titre
        $tableTxt .="<td>Titre : " . $dataB["booTitle"] ."</td>";
        $tableTxt .="<td>Nombre d'appréciations : " . $dataB["booNbrLikes"]/* select count * from */;
        $tableTxt .="</tr><br><tr>";
        $tableTxt .="<td></td>";
        $tableTxt .="<td>Auteur : " . $dataB["writer_id"] . "</td>";
        $tableTxt .="<td>Moyenne : " . $dataB["ratRate"] . "</td>"; /* script */
        ?>
    </div>
    <footer>
        <img src="./MEDIA/ICON/books.png" alt="books" class="item-1">
        <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
        <img src="./MEDIA/ICON/books.png" alt="books" class="item-1">
    </footer>
</body>
</html>