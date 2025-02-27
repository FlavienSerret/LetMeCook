<?php
// models/Favoris.php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Recette.php';  // Inclure le modèle Recette pour l'utiliser dans Favoris

class Favoris {
    private $conn;
    private $recetteModel;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->recetteModel = new Recette(); // Crée une instance du modèle Recette
    }

    // Récupérer toutes les recettes favorites d'un utilisateur
    public function getAllFavorites($userId) {
        $query = "SELECT f.idRecette 
                  FROM favoris f
                  WHERE f.idUser = :userId";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $favoriteRecettes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur a des favoris
        if (empty($favoriteRecettes)) {
            return [];  // Aucun favori, retourner un tableau vide
        }

        $recettesDetails = [];
        foreach ($favoriteRecettes as $favorite) {
            // Pour chaque recette favorite, récupérer les détails complets
            $recetteDetails = $this->recetteModel->getRecetteById($favorite['idRecette']);
            $noteMoyenne = $this->recetteModel->getAverageRating($favorite['idRecette']);

            // Ajouter la note moyenne aux détails de la recette
            $recetteDetails['noteMoyenne'] = $noteMoyenne;

            // Ajouter les détails de cette recette à la liste des recettes
            $recettesDetails[] = $recetteDetails;
        }

        return $recettesDetails;
    }
}

?>
