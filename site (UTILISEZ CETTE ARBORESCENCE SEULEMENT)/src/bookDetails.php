<?php
    session_start();
    include("./database.php");
    $db = new Database();

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
    // Permet de récupérer l'ID du livre
    $idBook = $_GET["bookId"];

    // Permet de récupérer les informations détaillées du livre
    $book = $db->getOneBook($idBook);
?>

<!DOCTYPE html>
<html lang="fr">
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
                    <?php
                        if (isset($_SESSION['user'])) 
                        {
                            // Interface si Utilisateur connecté
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
                            // Interface si Utilisateur non connecté
                            echo '<li class="nav-item-two"><a href="userLogin.php">Ajouter</a></li>';
                            echo '<li class="nav-item"><a href="userLogin.php">Connexion</a></li>';
                        }
                    ?>
                </ul>
            </nav>
            <div class="book-info-section">
                <?php
                    // Récupère le pseudo de l'utilisateur
                    $userPseudo = $db->getUsernameByUserId($book['user_fk']);

                    echo "<div class=\"book\">";
                    echo "<div class=\"book-cover\">";

                    // Ajoute le chemin de l'image de la couverture du livre si elle est donnée, sinon met un placeholder
                    if (file_exists($book['booCoverImage'])) {
                        echo "<img src=\"" . htmlspecialchars($book['booCoverImage']) . "\" alt=\"Couverture du livre\">";
                    } 
                    else 
                    {
                        echo "<img src=\"./path/to/default-cover.jpg\" alt=\"Couverture par défaut\">";
                    }

                    // vérifie l'id du livre et de l'utilisateur
                    echo "</div>";
                    echo "<div class=\"book-title\">";
                    echo htmlspecialchars($book['booTitle']);
                    echo "</div>";
                    echo "<br>";
                    echo "Auteur : " . htmlspecialchars($book['booWriter']);
                    echo "<br>";
                    echo "Nombre de pages : " . htmlspecialchars($book['booNbrPage']);
                    echo "<br>";
                    echo "Edition " . htmlspecialchars($book['booEditorName']);
                    echo "<br>";
                    if ($userPseudo) 
                    {
                        echo "Utilisateur : <a href='userDetails.php?user_id=" . htmlspecialchars($book['user_fk']) . "'>" . htmlspecialchars($userPseudo) . "</a>";
                    } 
                    else 
                    {
                        echo "Utilisateur : Inconnu";
                    }
                    echo "<br>";
                    echo "</div>";
                ?>
            </div>
        </main>
        <footer>
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
            <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
        </footer>
    </body>
</html>