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
    <link rel="stylesheet" href="./css/styleLeo.css">

</head>
    <body>
        <nav class="navbar">
            <ul>
                <li class="nav-item"><a href="index.php">Accueil</a></li>
                <li class="nav-item-two"><a href="">Livres</a></li>
                <li class="nav-logo"><a href=""><img src="./resources/img/logoRR.png" alt="Readers Realm logo"></a></li>
                <li class="nav-item-two"><a href="userDetails.php">Contact</a></li>
                <li class="nav-item"><a href="userLogin.php">Connexion</a></li>
            </ul>
        </nav>
        <!--(contenu unique à cette page) -->
        <div class="mainContainer">
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
                    <img src="./resources/img/couverture-livre1.png" alt="Titre du livre">
                    <div class="book-title">Titre du livre</div>
                </div>
                <div class="book">
                    <img src="./resources/img/couverture-livre2.png" alt="Titre du livre">
                    <div class="book-title">Titre du livre</div>
                </div>
                <div class="book">
                    <img src="./resources/img/couverture-livre3.png" alt="Titre du livre">
                    <div class="book-title">Titre du livre</div>
                </div>
                <div class="book">
                    <img src="./resources/img/couverture-livre4.png" alt="Titre du livre">
                    <div class="book-title">Titre du livre</div>
                </div>
                <div class="book">
                    <img src="./resources/img/couverture-livre5.png" alt="Titre du livre">
                    <div class="book-title">Titre du livre</div>
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
        </div> 
        <!--(contenu unique à cette page) --> 
    <footer>
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
        <p class="item-2">readersrealm@gmail.com <br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
    </footer>
</body>
</html>