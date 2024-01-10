<?php
session_start();
include("./database.php");
$db = new Database();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: userLogin.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];
    $errors = [];

    // Valider le titre du livre
    if (empty($_POST['bookName'])) {
        $errors[] = 'Le titre du livre est obligatoire.';
    }

    // Valider la catégorie du livre
    if (empty($_POST['bookCategory'])) {
        $errors[] = 'La catégorie du livre est obligatoire.';
    }

    //Compte le nombre d'erreurs
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
    } else {

        // Télécharge l'image de couverture du livre proposé si elle est changée
        if ($_FILES['coverImage']['error'] === 0) {
            $uploadDir = 'uploads/';
            $uniqueId = uniqid(); // Génère un ID unique
            $fileName = $uniqueId . '-' . basename($_FILES['coverImage']['name']);
            $uploadPath = $uploadDir . $fileName;
        
            // Gère les fichiers qui se déplacent dans le serveur
            if (move_uploaded_file($_FILES['coverImage']['tmp_name'], $uploadPath)) {
                echo 'Le fichier a été téléchargé avec succès.';
                $bookData['booCoverImage'] = $uploadPath;
            } else {
                echo 'Une erreur est survenue lors du téléchargement du fichier.';
                exit();
            }
        } else {
            echo 'Erreur lors du téléchargement de l\'image : ' . $_FILES['coverImage']['error'];
            exit();
        }    

        // Préparation du tableau de données pour la mise à jour du livre
        $bookData = [
            'category_fk' => $_POST['bookCategory'],
            'booWriter' => $_POST['writerFullName'],
            'booTitle' => $_POST['bookName'],
            'booExemplary' => $_POST['extraitBook'],
            'booResumeBook' => $_POST['bookSynopsis'],
            'booNbrPage' => $_POST['pageNbr'],
            'booEditorName' => $_POST['editorName'],
            'booEditionDate' => $_POST['releaseDate'],
            'booCoverImage' => $uploadPath, 
        ];

        try {
            $db->updateBook($bookId, $bookData);
            echo "Livre mis à jour avec succès.";
        } catch (Exception $e) {
            die('Erreur lors de la mise à jour du livre : ' . $e->getMessage());
        }
    }
} else {
    echo "Demande non valide.";
}
?>
