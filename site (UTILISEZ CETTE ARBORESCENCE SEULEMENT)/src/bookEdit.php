<?php
session_start();
include("./database.php");
$db = new Database();

// Vérifier si l'utilisateur est connecté et l'ID du livre est fourni
if (!isset($_SESSION['user']) || !isset($_GET['book_id'])) {
    header('Location: userLogin.php'); // Rediriger si non connecté ou pas d'ID de livre
    exit();
}

$bookId = $_GET['book_id'];
$book = $db->getBookById($bookId); // Méthode pour récupérer les détails du livre par ID
$user = $_SESSION['user'];

// Rediriger si le livre n'existe pas ou si l'utilisateur n'est pas le propriétaire
if (!$book || $book['user_fk'] != $_SESSION['user']['user_id']) {
    header('Location: userBooks.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>bookEdit</title>
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
            <!--Contenu dynamique -->
            <br><br>
            <h1 id="bookTitle">Quel livre<br>souhaitez-vous ajouter ?
            </h1>
            <br><br><br>
            <div class="flexboxContainerAddBook">
            <form action="bookUpdateCheck.php" method="post" class="myForm" enctype="multipart/form-data">
                <div class="flexbox" id="flexbox-item-1">
                    <?php
                        if (isset($_SESSION['user'])) {
                            echo '<input type="hidden" name="userID" value="' . $user['user_id'] . '">';
                        }
                        // Champ caché pour indiquer la mise à jour d'un livre
                        if (isset($bookId)) {
                            echo '<input type="hidden" name="book_id" value="' . $bookId . '">';
                        }
                    ?>
                    <label for="txtBookName">TITRE DU LIVRE<br></label>
                    <input type="text" id="bookName" name="bookName" value="<?php echo htmlspecialchars($book['booTitle'] ?? ''); ?>"><br><br>
                    <label for="bookCategory">CATEGORIE<br></label>
                    <select id="bookCategory" name="bookCategory">
                        <?php
                        // Création des catégories possible des livres 
                            $categories = [
                                ['category_id' => 1, 'catCategory' => 'Horreur'],
                                ['category_id' => 2, 'catCategory' => 'Comédie'],
                                ['category_id' => 3, 'catCategory' => 'Science-fiction'],
                                ['category_id' => 4, 'catCategory' => 'Policier'],
                            ];
                            foreach ($categories as $category) {
                                echo "<option value='" . $category['category_id'] . "'";
                                if (isset($book['category_fk']) && $category['category_id'] == $book['category_fk']) {
                                    echo " selected";
                                }
                                echo ">" . htmlspecialchars($category['catCategory']) . "</option>";
                            }
                        ?>
                    </select><br><br>
                    <!-- Formulaire de création du livre -->
                    <label for="quantity">NOMBRE DE PAGE<br></label>
                    <input type="number" id="pageNbr" name="pageNbr" min="1" max="9999" value="<?php echo htmlspecialchars($book['booNbrPage'] ?? ''); ?>">
                    <br><br>
                    <label for="extrait">EXTRAIT<br></label>
                    <input type="text" id="extraitBook" name="extraitBook" value="<?php echo htmlspecialchars($book['booExemplary'] ?? 'LIEN PDF'); ?>">
                </div>
                <div class="flexbox" id="flexbox-item-2">
                    <label for="bookSynopsis">SYNOPSIS<br></label>
                    <textarea id="bookSynopsis" name="bookSynopsis" rows="8" cols="50"><?php echo htmlspecialchars($book['booResumeBook'] ?? ''); ?></textarea>
                </div>
                <div class="flexbox" id="flexbox-item-1">
                    <label for="txtWriterFullName">NOM ET PRENOM DE L'AUTEUR<br></label>
                    <input type="text" id="writerFullName" name="writerFullName" value="<?php echo htmlspecialchars($book['booWriter'] ?? ''); ?>">
                    <br><br>
                    <label for="editorName">NOM DE L'EDITEUR<br></label>
                    <input type="text" id="editorName" name="editorName" value="<?php echo htmlspecialchars($book['booEditorName'] ?? ''); ?>">
                    <br><br>
                    <label for="releaseDate">ANNEE D'EDITION<br></label>
                    <?php

                    // Enregistre la date entrée dans le formulaire si elle correspond au format
                    $dateValue = isset($book['booEditionDate']) ? date('Y-m-d', strtotime($book['booEditionDate'])) : '';
                    ?>
                    <input type="date" id="releaseDate" name="releaseDate" value="<?php echo htmlspecialchars($dateValue); ?>">
                    <br><br>
                    <label for="extrait">COUVERTURE DU LIVRE<br></label>
                    <input type="file" id="coverImage" name="coverImage" accept=".png, .jpeg, .jpg">
                </div>
                <div class="subButton">
                    <input type="submit" value="Envoyer">
                </div>
            </form>
            </div>
            <!--(contenu unique à cette page) -->
        </main>
        <footer>
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
            <p class="item-2"><a href="mailto:readersrealm@gmail.com">readersrealm@gmail.com</a><br> Théo Ghaemmagami | Yann Mangiagli | Leonar Sadriu | Harun Findik</p> 
            <img src="../src/resources/img/books.png" alt="books" class="item-1">
        </footer>
    </body>
</html>