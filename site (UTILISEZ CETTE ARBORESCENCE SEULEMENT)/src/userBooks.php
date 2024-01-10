<?php
session_start();
include("./database.php");
$db = new Database();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $userBooks = $db->getBooksByUserId($user['user_id']);
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
        <title>Document</title>
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
            <h2 class="book-section-title">Voici les derniers livres que vous avez ajoutés</h2>
            <hr>
            <div class="book-section">
                <!-- Répétition de la structure pour chaque livre (contenu unique à cette page) -->
                   <?php
                   foreach ($userBooks as $book) {
                    // Assure-toi que le chemin de l'image est correct et existe
                    $coverImagePath = "./" . $book['booCoverImage']; // Modifie le chemin si nécessaire
                
                    echo "<div class=\"book\">";
                    if (file_exists($coverImagePath)) {
                        echo "<img src=\"" . htmlspecialchars($coverImagePath) . "\" alt=\"" . htmlspecialchars($book['booTitle']) . "\">";
                    } else {
                        echo "<img src=\"./path/to/default-cover.jpg\" alt=\"Couverture par défaut\">"; // Chemin vers une image de couverture par défaut
                    }
                    echo "<div class=\"book-title\">" . htmlspecialchars($book['booTitle']) . "</div>";
                    echo "<div class=\"book-actions\">";
                    // Bouton Modifier - Redirige vers une page de modification avec l'ID du livre en paramètre
                    echo "<button class=\"book-action\" onclick=\"location.href='bookEdit.php?book_id=" . htmlspecialchars($book['book_id']) . "'\">Modifier</button>";
                    // Bouton Supprimer - Peut appeler une fonction JavaScript pour gérer la suppression
                    echo "<button class=\"book-action\" onclick=\"confirmDelete('" . htmlspecialchars($book['book_id']) . "')\">Supprimer</button>";
                    echo "</div>";
                    echo "</div>";
                }
                // JavaScript pour la confirmation de suppression
                echo "<script>
                function confirmDelete(bookId) {
                    if (confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')) {
                        location.href = 'deleteBook.php?book_id=' + bookId;
                    }
                }
                </script>";
                   ?>
        </main>
        <footer>
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
            <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
        </footer>
    </body>
</html>