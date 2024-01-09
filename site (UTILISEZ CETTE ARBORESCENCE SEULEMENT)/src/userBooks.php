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
                <div class="book">
                    <img src="./resources/img/couverture-livre1.png" alt="Titre du livre">
                    <div class="book-title">Titre du livre</div>
                        <div class="book-actions">
                            <button class="book-action">Modifier</button>
                            <button class="book-action">Supprimer</button>
                        </div>
                    </div>
                    <div class="book">
                        <img src="./resources/img/couverture-livre2.png" alt="Titre du livre">
                        <div class="book-title">Titre du livre</div>
                        <div class="book-actions">
                            <button class="book-action">Modifier</button>
                            <button class="book-action">Supprimer</button>
                        </div>
                    </div>
                    <div class="book">
                        <img src="./resources/img/couverture-livre3.png" alt="Titre du livre">
                        <div class="book-title">Titre du livre</div>
                        <div class="book-actions">
                            <button class="book-action">Modifier</button>
                            <button class="book-action">Supprimer</button>
                        </div>
                    </div>
                    <div class="book">
                        <img src="./resources/img/couverture-livre4.png" alt="Titre du livre">
                        <div class="book-title">Titre du livre</div>
                        <div class="book-actions">
                            <button class="book-action">Modifier</button>
                            <button class="book-action">Supprimer</button>
                        </div>
                    </div>
                    <div class="book">
                        <img src="./resources/img/couverture-livre5.png" alt="Titre du livre">
                        <div class="book-title">Titre du livre</div>
                        <div class="book-actions">
                            <button class="book-action">Modifier</button>
                            <button class="book-action">Supprimer</button>
                        </div>
                    </div>
                    <!-- Fin de la structure pour un livre -->
                    </div>
                </div>  
        </main>
        <footer>
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
            <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
        </footer>
    </body>
</html>