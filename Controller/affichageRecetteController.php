<?php
require_once __DIR__ . '/../models/AfficherEtapes.php';
require_once __DIR__ . '/../models/Ingredient.php';
require_once __DIR__ . '/../models/Recette.php';

class AffichageRecetteController {
    public function afficherRecette($idRecette) {
        // Vérification de l'ID
        if (!isset($idRecette) || !is_numeric($idRecette)) {
            header("Location: ../../index.php");
            exit();
        }

        // Récupérer les données via les modèles
        $recetteModel = new Recette();
        $recette = $recetteModel->getRecetteById($idRecette);
        if (!$recette) {
            header("Location: ../../index.php");
            exit();
        }

        $ingredientModel = new Ingredient();
        $ingredients = $ingredientModel->getIngredientsByRecetteId($idRecette);

        $etapesModel = new AfficherEtapes();
        $etapes = $etapesModel->getEtapesByRecetteId($idRecette);

        $nombreDePersonne = $recette['nombreDePersonne'];
        $noteMoyenne = $recetteModel->getAverageRating($idRecette);

        // Inclure la vue avec les données
        require_once __DIR__ . '/../view/php/recette.php';
    }
}
?>
