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
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recherche de livre</title>
        <link rel="stylesheet" href="./CSS/styleLeo.css">
    </head>
    <body>
        <main>
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
            <div class="searchArea">
                <h2>Quel livre recherchez-vous ?</h2>
                <hr class="horizontalLine">
                <form class="searchBar" method="post">
                    <input type="text" class="search" id="search" name="search" placeholder="Rechercher...">
                    <button type="submit" class="searchButton">
                        <img src="../src/resources/img/Search.png" class="searchIcon">
                    </button>
                </form>
            </div>
            <!-- Section d'affichage des résultats de la recherche -->
            <div class="search-results">
            <div class="book-section">
                <?php
                if (isset($_POST['search'])) {
                    require "bookSearchResults.php"; // Ce fichier doit remplir le tableau $books avec les résultats de recherche
                    if ($result > 0) {
                        foreach ($results as $book) {
                            // Assure-toi que le chemin de l'image est correct et existe
                            $coverImagePath = "./" . $book['booCoverImage']; // Modifie le chemin si nécessaire

                            // Récupère le pseudo de l'utilisateur
                            $userPseudo = $db->getUsernameByUserId($book['user_fk']);

                            echo "<div class=\"book\">";
                            echo "<div class=\"book-cover\">";
                            echo "<a href='bookDetails.php?book_id=" . htmlspecialchars($book['book_id']) . "'>";

                            // Ajoute le chemin de l'image de la couverture du livre si elle est donnée, sinon met un placeholder
                            if (file_exists($coverImagePath)) {
                                echo "<img src=\"" . htmlspecialchars($coverImagePath) . "\" alt=\"Couverture du livre\">";
                            } else {
                                echo "<img src=\"./path/to/default-cover.jpg\" alt=\"Couverture par défaut\">";
                            }

                            // vérifie l'id du livre et de l'utilisateur
                            echo "</a>";
                            echo "</div>";
                            echo "<div class=\"book-title\">";
                            echo "<a href='bookDetails.php?book_id=" . htmlspecialchars($book['book_id']) . "'>" . htmlspecialchars($book['booTitle']) . "</a>";
                            echo "</div>";
                            echo "<br>";
                            echo "Auteur : " . htmlspecialchars($book['booWriter']);
                            echo "<br>";
                            if ($userPseudo) {
                                echo "Utilisateur : <a href='userDetails.php?user_id=" . htmlspecialchars($book['user_fk']) . "'>" . htmlspecialchars($userPseudo) . "</a>";
                            } else {
                                echo "Utilisateur : Inconnu";
                            }
                            echo "<br>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div>Pas de resultat</div>";
                    }
                }
                ?>
            </div>
            </div>
            </div>
            <div class="categories">
                <a href="bookCategory.php?cat_id=1"><img src="../src/resources/img/horrorCategory.png" alt="Horreur"></a>
                <a href="bookCategory.php?cat_id=2"><img src="../src/resources/img/ComedieCategory.png" alt="Comédie"></a>
                <a href="bookCategory.php?cat_id=3"><img src="../src/resources/img/sfCategory.png" alt="Science-fiction"></a>
                <a href="bookCategory.php?cat_id=4"><img src="../src/resources/img/policeCategory.png" alt="Policier"></a>
            </div>
        </main>
        <footer>
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
            <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
        </footer>
    </body>
</html>