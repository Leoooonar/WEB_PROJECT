<?php
session_start();

include("./database.php");
$db = new Database();

// Validation du formulaire
if (isset($_POST['username']) && isset($_POST['password'])) {
    $errors = []; // Initialiser un tableau pour stocker les erreurs

    // Valider le nom d'utilisateur (login)
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors[] = 'Le nom d\'utilisateur n\'est pas valide. Utilisez uniquement des lettres, des chiffres et des underscores (_).';
    }

    // Valider le mot de passe
    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[A-Za-z\d]{8,}$/', $_POST['password'])) {
        $errors[] = 'Le mot de passe n\'est pas valide. Il doit contenir au moins 8 caractères, dont au moins une lettre et un chiffre.';
    }

    // Si des erreurs sont présentes
    if (count($errors) > 0) {
        // Afficher les messages d'erreur
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
    } else {
        $user = $db->loginUser($_POST['username'], $_POST['password']);

        if ($user) {
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['user'] = $user;

            // Rediriger l'utilisateur vers une page sécurisée ou l'accueil
            header('Location: index.php');
            exit();
        }
        else
        {
            echo 'Raté';
        }
    }
}