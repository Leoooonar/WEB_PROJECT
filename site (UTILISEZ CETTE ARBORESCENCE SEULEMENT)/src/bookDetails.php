<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // Affichez les informations de l'utilisateur, par exemple, son nom d'utilisateur
    echo 'Bienvenue, ' . $user['useUsername'] . '!';
    // Inclure d'autres fonctionnalités réservées aux utilisateurs connectés
} else {
    // L'utilisateur n'est pas connecté, affichez un message approprié
    echo 'Veuillez vous connecter pour accéder à cette page.';
    // Afficher un lien de connexion ici si nécessaire
}
?>
<!DOCTYPE html>
<html lang="fr">
<<<<<<< Updated upstream
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
                <li class="nav-item-one"><a href="index.php">Accueil</a></li>
                <li class="nav-item-two"><a href="bookSearch.php">Livres</a></li>
                <li class="nav-logo"><a href=""><img src="./resources/img/logoRR.png" alt="Readers Realm logo"></a></li>
                <?php
                    if (isset($_SESSION['user'])) 
                    {
                        // Utilisateur connecté
                        echo '<li class="nav-item-two"><a href="bookAdd.php">Ajouter</a></li>';
                        echo '<li class="nav-item dropdown">';
                        echo '<a href="javascript:void(0)" class="dropbtn">Mon compte</a>';
                        echo '<div class="dropdown-content">';
                        echo '<a href="userDetails.php">Détail du compte</a>';
                        echo '<a href="userBooks.php">Mes livres</a>';
                        echo '<a href="logout.php">Déconnexion</a>';
                        echo '</div>';
                        echo '</li>';
                    } 
                    else 
                    {
                        // Utilisateur non connecté
                        echo '<li class="nav-item-two"><a href="userLogin.php">Ajouter</a></li>';
                        echo '<li class="nav-item"><a href="userLogin.php">Connexion</a></li>';
                    }
                ?>
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
=======
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/styleLeo.css">
</head>
    <body>
        <main>
        <nav class="navbar">
                <ul>
                    <li class="nav-item-one"><a href="index.php">Accueil</a></li>
                    <li class="nav-item-two"><a href="">Livres</a></li>
                    <li class="nav-logo"><a href=""><img src="./resources/img/logoRR.png" alt="Readers Realm logo"></a></li>
                    <li class="nav-item-two"><a href="userDetails.php">Contact</a></li>
                    <?php
            if (isset($_SESSION['user'])) {
                // Utilisateur connecté
                echo '<li class="nav-item dropdown">';
                echo '<a href="javascript:void(0)" class="dropbtn">Mon compte</a>';
                echo '<div class="dropdown-content">';
                echo '<a href="userDetails.php">Détail du compte</a>';
                echo '<a href="userBooks.php">Mes livres</a>';
                echo '<a href="bookAdd.php">Ajouter un livre</a>';
                echo '<a href="logout.php">Déconnexion</a>';
                echo '</div>';
                echo '</li>';
            } else {
                // Utilisateur non connecté
                echo '<li class="nav-item"><a href="userLogin.php">Connexion</a></li>';
            }
            ?>
            </ul>
            </nav>
        </main>
    <footer>
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
        <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
    </footer>
</body>
>>>>>>> Stashed changes
</html>