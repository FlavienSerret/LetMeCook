<?php
// Démarrer la session pour manipuler les variables de session
session_start();

// Inclure le modèle User pour la gestion de la connexion
require_once __DIR__ . '/../models/User.php';

// Vérifier si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données envoyées par le formulaire
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); // Assurer que l'email est bien formaté
    $password = $_POST["password"]; // Récupérer le mot de passe

    // Vérification que les champs ne sont pas vides
    if (empty($email) || empty($password)) {
        header("Location: ../view/php/login.php?error=missing_fields");
        exit();
    }

    // Instancier le modèle User
    $user = new User();

    // Appeler la méthode de login et obtenir les données de l'utilisateur
    $user_data = $user->login($email, $password);

    // Si l'utilisateur existe et que le mot de passe est correct
    if ($user_data) {
        // Si le mot de passe est correct, on enregistre les informations dans la session
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['user_nom'] = $user_data['nom'];
        $_SESSION['user_prenom'] = $user_data['prenom'];
        $_SESSION['user_email'] = $user_data['mail'];
        $_SESSION['user_type'] = $user_data['type'];  // 1 pour cuisinier, 0 pour apprenti

        // Rediriger vers la page d'accueil ou une autre page après la connexion
        header("Location: ../index.php");
        exit();
    } else {
        // Si les informations de connexion sont incorrectes
        header("Location: ../view/php/login.php?error=invalid_credentials");
        exit();
    }
}
