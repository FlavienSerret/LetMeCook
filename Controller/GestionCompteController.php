<?php
// GestionCompteController.php

require_once __DIR__ . '/../models/Favoris.php';  // Si tu as besoin de gérer les favoris dans ce contrôleur
require_once __DIR__ . '/../models/Recette.php';  // Si tu veux afficher les créations des recettes
require_once __DIR__ . '/../models/UserGestion.php';     // Modèle pour l'utilisateur (si nécessaire)

class GestionCompteController {
    private $recetteModel;

    public function __construct() {
        $this->recetteModel = new Recette(); // On crée une instance pour récupérer les créations de recettes
    }

    // Dans GestionCompteController.php
    public function afficherGestionCompte() {
        // Démarre la session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header("Location: /view/php/login.php");
            exit();
        }

        // L'utilisateur est connecté
        $userId = $_SESSION['user_id'];

        // Récupère les informations de l'utilisateur pour savoir s'il est un chef
        $user = new User();
        $isChef = $user->isChef($userId);  // Si tu as une méthode isChef() dans le modèle User

        // Si l'utilisateur est un chef, récupérer ses créations de recettes
        if ($isChef) {
            // On récupère toutes les recettes du chef
            $recettes = $this->recetteModel->getRecetteByUserId($userId);  // Appelle la nouvelle méthode qui récupère toutes les recettes d'un utilisateur
        } else {
            $recettes = [];
        }

        // Charge la vue pour la gestion du compte
        require_once __DIR__ . '/../view/php/GestionCompte.php';
    }

}
?>