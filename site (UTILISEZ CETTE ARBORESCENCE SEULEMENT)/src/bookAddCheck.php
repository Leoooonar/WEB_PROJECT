<?php
session_start();

include("./database.php");
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Valider le titre du livre
    if (empty($_POST['bookName'])) {
        $errors[] = 'Le titre du livre est obligatoire.';
    }

    // Valider la catégorie du livre
    if (empty($_POST['bookCategory'])) {
        $errors[] = 'La catégorie du livre est obligatoire.';
    }

    // Ajoutez d'autres validations au besoin...

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
    } else {

        // Mise à jour du nombre de livres proposés par l'utilisateur
        $newCount = $db->incrementUserNbrProposedBooks($_SESSION['user']['user_id']);

        // Mettez à jour la valeur dans la variable $user avec la nouvelle valeur
        $_SESSION['user']['useNbrProposedBook'] = $newCount;

        echo '<br>';
        var_dump($newCount);
        echo '<br>';

        echo '<br>';
        var_dump($_SESSION['user']);
        echo '<br>';

        $bookData = [
            'category_fk' => $_POST['bookCategory'],
            'writer_fk' => NULL, // A MODIFIER 
            'user_fk' => NULL, // A MODIFIER 
            'booTitle' => $_POST['bookName'],
            'booExemplary' => 1, // A MODIFIER 
            'booResumeBook' => $_POST['bookSynopsis'],
            'booNbrPage' => $_POST['pageNbr'],
            'booEditorName' => $_POST['editorName'],
            'booLikeRatio' => 0, // A MODIFIER 
            'writerLastName' => $_POST['writerLastName'], 
            'writerFirstName' => $_POST['writerFirstName'],
            'booEditionDate' => $_POST['releaseDate'], 
        ];

        if ($_FILES['coverImage']['error'] === 0) {
            $uploadDir = 'uploads/';
            $fileName = basename($_FILES['coverImage']['name']);
            $uploadPath = $uploadDir . $fileName;

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

        try {
            $db->addBook($bookData);
        } catch (Exception $e) {
            die('Erreur lors de l\'ajout du livre : ' . $e->getMessage());
        }
    }
}
?>
