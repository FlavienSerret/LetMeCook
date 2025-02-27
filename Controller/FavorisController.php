<?php
// FavorisController.php

require_once __DIR__ . '/../models/Favoris.php';

class FavorisController {
    private $favorisModel;

    public function __construct() {
        $this->favorisModel = new Favoris();  // Crée une instance du modèle Favoris
    }

    public function afficherFavoris() {
        // Démarre la session
        session_start();

        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            // Si non, redirige vers la page de login
            header("Location: /view/php/login.php");
            exit();  // Assure que l'exécution du script s'arrête après la redirection
        }

        // L'utilisateur est connecté, donc on continue
        $userId = $_SESSION['user_id'];

        // Récupère toutes les recettes favorites pour l'utilisateur
        $recettes = $this->favorisModel->getAllFavorites($userId);

        // Passe les variables nécessaires à la vue
        require_once __DIR__ . '/../view/php/favoris.php';
    }
}

?>
