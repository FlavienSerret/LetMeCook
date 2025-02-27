<?php
// controllers/RegisterController.php
require_once __DIR__ . '/../models/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données envoyées par le formulaire
    $nom_prenom = $_POST["nom_prenom"];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $type = $_POST["type"];

    // Vérification que tous les champs sont remplis
    if (empty($nom_prenom) || empty($email) || empty($password) || !isset($type)) {
        header("Location: ../view/php/login.php?error=missing_fields");
        exit();
    }

    // Vérification si l'email existe déjà
    $user = new User();
    if ($user->checkEmailExists($email)) {
        header("Location: ../view/php/login.php?error=email_exists");
        exit();
    }

    // Séparation du nom et prénom
    $nom_prenom_array = explode(' ', $nom_prenom);
    if (count($nom_prenom_array) < 2) {
        header("Location: ../view/php/login.php?error=missing_name_or_surname");
        exit();
    }

    $nom = $nom_prenom_array[0]; // Le nom est la première partie
    $prenom = $nom_prenom_array[1]; // Le prénom est la deuxième partie

    // Créer un nouvel utilisateur
    if ($user->register($nom, $prenom, $email, $password, $type)) {
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../view/php/login.php?error=registration_failed");
        exit();
    }
}

?>
