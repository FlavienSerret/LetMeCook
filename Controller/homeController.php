<?php
// Controller/HomeController.php

require_once __DIR__ . '/../models/RecetteAcceuil.php';
require_once __DIR__ . '/../models/Live.php';


class HomeController {

    private $recetteModel;
    private $liveModel;

    public function __construct() {
        // Initialisation des modèles
        $this->recetteModel = new RecetteAcceuil();
        $this->liveModel = new Live();
    }

    // Controller/HomeController.php

    // Controller/HomeController.php

    public function index() {
        // Récupérer la page actuelle
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Nombre de recettes par page
        $recettesParPage = 12;

        // Récupérer les recettes avec pagination
        $recettes = $this->recetteModel->getPaginated($currentPage, $recettesParPage);

        // Récupérer la note moyenne et le prix total pour chaque recette
        foreach ($recettes as &$recette) {
            $recette['noteMoyenne'] = $this->recetteModel->getAverageRating($recette['id']);
            $recette['prixTotal'] = $this->recetteModel->getTotalPrice($recette['id']);
        }

        // Récupérer le nombre total de recettes
        $totalRecettes = $this->recetteModel->countRecettes();

        // Calculer le nombre total de pages
        $totalPages = ceil($totalRecettes / $recettesParPage);

        // Récupérer les lives
        $lives = $this->liveModel->getAll();

        // Charger la vue avec les données
        require_once __DIR__ . '/../view/php/home.php';
    }


}
?>
