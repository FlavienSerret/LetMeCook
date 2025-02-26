<?php
// models/RecetteAcceuil.php

require_once __DIR__ . '/../config/database.php';

class RecetteAcceuil {
    private $conn;
    private $table = "recette";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // ✅ Nouvelle méthode pour récupérer les recettes par page
    public function getPaginated($currentPage, $recettesParPage) {
        // Calculer le point de départ pour la requête SQL
        $offset = max(0, ($currentPage - 1) * $recettesParPage);

        // Requête SQL pour récupérer les recettes avec une limite et un offset
        $query = "SELECT * FROM " . $this->table . " ORDER BY datePublication DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $recettesParPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        // Retourner les recettes sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// Ajouter la méthode pour compter le nombre total de recettes
    public function countRecettes() {
        $query = "SELECT COUNT(*) AS total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

// models/RecetteAcceuil.php

    public function getAverageRating($idRecette) {
        $query = "SELECT AVG(note) AS moyenne FROM noterecette WHERE idRecette = :idRecette";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idRecette", $idRecette, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['moyenne'] ? round($result['moyenne'], 1) : 0;  // Retourne la moyenne arrondie à 1 décimale
    }
// models/RecetteAcceuil.php

    // models/RecetteAcceuil.php

    public function getTotalPrice($recetteId) {
        // Requête SQL pour récupérer les ingrédients et leurs informations de prix et portion
        $query = "
        SELECT 
            i.prixRef, 
            i.portionRef, 
            c.quantite
        FROM ingredient i
        JOIN contientrecette c ON i.id = c.idIngredient
        WHERE c.idRecette = :idRecette
    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idRecette', $recetteId, PDO::PARAM_INT);
        $stmt->execute();

        $prixTotal = 0;

        // Calculer le prix total en tenant compte de la quantité et de la portion
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prixIngrédient = ($row['prixRef'] / $row['portionRef']) * $row['quantite'];
            $prixTotal += $prixIngrédient;
        }

        // Retourner le prix total arrondi à 2 décimales
        return round($prixTotal, 2);
    }



}
?>
