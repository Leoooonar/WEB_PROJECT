<?php
session_start();
require 'database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: userLogin.php');
    exit;
}

// Création d'une instance de la classe Database
$db = new Database('localhost', 'nom_de_votre_base_de_donnees', 'votre_nom_utilisateur', 'votre_mot_de_passe');

// Récupérer l'identifiant de l'utilisateur depuis l'URL
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

// Utiliser la méthode getUserById pour obtenir les informations de l'utilisateur
$bookUser = $db->getUserById($user_id);

// Vérifier si l'utilisateur existe
if (!$bookUser) {
    echo "Utilisateur introuvable.";
    exit;
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
            <div class="user-info-section">
                <h2 class="username">Nom de l'utilisateur : <span class="highlight"><?php echo htmlspecialchars($bookUser['useUsername']); ?></span></h2>
                <br>
                <p class="user-stats">Nombre d'ouvrages proposés : <span class="highlight"><?php echo htmlspecialchars($bookUser['useNbrProposedBook']); ?></span></p>
                <br>
            </div>
        </main>
        <footer>
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
            <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
        </footer>
    </body>
</html>
