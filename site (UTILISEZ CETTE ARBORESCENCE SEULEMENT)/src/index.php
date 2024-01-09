<?php
session_start();

// Récupère les derniers livres ajoutés
$lastAddedBooks = $db->getLastAddedBooks();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // Affichez les informations de l'utilisateur, par exemple, son nom d'utilisateur
    echo 'Bienvenue, ' . $user['useUsername'] . '!';
    var_dump($user);
    // Inclure d'autres fonctionnalités réservées aux utilisateurs connectés
} 
else {
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
    <link rel="stylesheet" href="./css/styleLeo.css">
</head>
    <body>
        <main>
            <nav class="navbar">
                <ul>
                    <li class="nav-item-one"><a href="index.php">Accueil</a></li>
                    <li class="nav-item-two"><a href="bookSearch.php">Livres</a></li>
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
                echo '<a href="bookAdd.php?user_id=' . $user['user_id'] . '">Ajouter un livre</a>';
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
            <!--(contenu unique à cette page) -->
                <div class="intro-section">
                    <h1>Découvrez, Partagez, Échangez</h1>
                    <div class="intro-columns">
                        <div class="intro-column">
                            <h2 class="section-title">Découvrez</h2>
                            <p class="text-style">Découvrez de nouveaux ouvrages en parcourant notre bibliothèque virtuelle sans limite en constante expansion grâce à l'ajout régulier des utilisateurs.</p>
                        </div>
                        <div class="intro-column">
                            <h2 class="section-title">Partagez</h2>
                            <p class="text-style">Partagez votre expérience de lecteur. Apportez votre pierre à l'édifice en libérant votre expression et en exprimant votre opinion sur divers livres.</p>
                        </div>
                    </div>
                </div>
                <h2 class="section-title">Derniers ajouts</h2>
                <hr>
                <div class="book-section">
                    <div class="book">
                        <?php
                            foreach($lastAddedBooks as $book)
                            {
                                echo "<div class=\"book-title\">";
                                echo $book['booTitle'];
                                echo "</div>";
                            }
                        ?>
                    </div>
                    
                </div>
                <hr>
                <div class="exchange-section">
                    <h2 class="section-title">Échangez</h2>
                    <br>
                    <p class="text-style">Échangez, débattez avec d'autres passionnés et passionnées. La raison d'être de ce site est l'échange d'opinions diverses offrant aux lecteurs votre perspective.</p>
                </div>
                <div class="footer-section">
                    <br>
                    <p class="text-style">Ici, chaque livre est une expérience partagée.</p>
                </div>
        </main>
        <!--(contenu unique à cette page) --> 
    <footer>
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
        <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
    </footer>
</body>
</html>