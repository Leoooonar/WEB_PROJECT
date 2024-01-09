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
                <div class="form-content">
                    <div class="login-png">    
                        <img src="./resources/img/login.png" alt="">
                    </div>
                    <form action="userRegistrationCheck.php" method="POST">
                        <h1 class="form-title">Inscription</h1> 
                        <div class="label-content">
                            <label><b>Email</b></label>
                            <br>
                            <input type="text" placeholder="Entrer le l'email" name="email">
                        </div>
                        <br>
                        <div class="label-content">
                            <label><b>Nom d'utilisateur</b></label>
                            <br>
                            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username">
                        </div>
                        <br>
                        <div class="label-content">
                            <label><b>Mot de passe</b></label>
                            <br>
                            <input type="password" placeholder="Entrer le mot de passe" name="password">
                            <br>
                        </div>
                        <div class="label-content">
                            <input type="submit" id='submit' value='INSCRIRE' >
                        </div>
                    </form>
                </div> 
            </main>
    <footer>
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
        <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
    </footer>
</body>
</html>