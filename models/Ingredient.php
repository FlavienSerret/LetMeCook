<?php
require_once __DIR__ . '/../config/database.php';

class Ingredient {
    private $conn;
    private $table = "ingredient";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer les ingrédients par ID de recette, avec l'unité
    public function getIngredientsByRecetteId($idRecette) {
        $query = "SELECT i.nom, ci.quantite, u.type AS unite 
                  FROM contientrecette ci
                  JOIN ingredient i ON ci.idIngredient = i.id
                  JOIN unite u ON i.uniteId = u.id  -- Correction ici (anciennement 'uniteld')
                  WHERE ci.idRecette = :idRecette";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idRecette", $idRecette, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
