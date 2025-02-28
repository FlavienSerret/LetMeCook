<?php

// Inclure les contrôleurs
require_once __DIR__ . '/Controller/homeController.php';
require_once __DIR__ . '/Controller/affichageRecetteController.php';
require_once __DIR__ . '/Controller/AffichageLiveController.php';
require_once __DIR__ . '/Controller/FavorisController.php';
require_once __DIR__ . '/Controller/GestionCompteController.php'; // Inclure le contrôleur de gestion du compte
require_once __DIR__ . '/Controller/CreerRecetteController.php'; // Inclure le contrôleur pour créer une recette
require_once __DIR__ . '/Controller/CreerRecetteLiveController.php'; // Inclure le contrôleur pour créer une recette

// Vérifier si une page est demandée via l'URL
// index.php

// Vérifier si une page est demandée via l'URL
$page = $_GET['page'] ?? 'home'; // Par défaut, la page est "home"

switch ($page) {
    case 'recette':
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $controller = new AffichageRecetteController();
            $controller->afficherRecette($_GET['id']);
        } else {
            header("Location: index.php"); // Redirige si l'ID est invalide
            exit();
        }
        break;

    case 'live': // Affichage d'un live spécifique
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $controller = new AffichageLiveController();
            $controller->afficherLive($_GET['id']);
        } else {
            header("Location: index.php?page=lives"); // Redirection si l'ID est invalide
            exit();
        }
        break;

    case 'creerrecette':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Gérer la soumission du formulaire de création de recette
            $controller = new CreerRecetteController();
            $controller->traiterFormulaire(); // Traite le formulaire (insertion des données)
        } else {
            // Afficher le formulaire de création de recette
            $controller = new CreerRecetteController();
            $controller->afficherFormulaire(); // Affiche le formulaire
        }
        break;

    case 'creerlive':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Gérer la soumission du formulaire de création de recette
            $controller = new CreerRecetteLiveController();
            $controller->traiterFormulaire(); // Traite le formulaire (insertion des données)
        } else {
            // Afficher le formulaire de création de recette
            $controller = new CreerRecetteLiveController();
            $controller->afficherFormulaire(); // Affiche le formulaire
        }
        break;

    case 'home':
    default:
        $controller = new HomeController();
        $controller->index();
        break;

    case 'favoris':
        // Contrôleur pour afficher les favoris avec gestion de la pagination
        $controller = new FavorisController();
        $controller->afficherFavoris();
        break;

    case 'gestioncompte':
        // Contrôleur pour afficher la gestion du compte
        $controller = new GestionCompteController();
        $controller->afficherGestionCompte();
        break;
}

?>
