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
                <div class="user-info-section">
                    <h2 class="username">Nom de l'utilisateur : <span class="highlight"><?php echo $user['useUsername']; ?></span></h2>
                    <br>
                    <p class="user-stats">Nombre d'ouvrages proposés : <span class="highlight"><?php echo $user['useNbrProposedBook']; ?></span></p>
                    <br>
                    <?php 
                    $deleteLink = "javascript:confirmDelete('" . $user["user_id"] . "')";
                    echo '<a href="' . $deleteLink . '">Supprimer le compte</a>';
                    ?>
                </div>


        </main>
    <footer>
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
        <p class="item-2">readersrealm@gmail.com <br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
        <img src="../src/resources/img/books.png" alt="books" class="item-1">
    </footer>
</body>
</html>