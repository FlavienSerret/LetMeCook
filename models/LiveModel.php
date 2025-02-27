<?php
require_once __DIR__ . '/../config/database.php';

class LiveModel {
    private $conn;
    private $table = "live";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getLiveById($id) {
        // Sélectionner les informations du live et du cuisinier
        $query = "SELECT l.*, u.nom AS nomChef
              FROM live l
              JOIN user u ON l.idUser = u.id
              WHERE l.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $live = $stmt->fetch(PDO::FETCH_ASSOC);

        // Sélectionner les ingrédients associés au live avec le type d'unité
        $ingredientQuery = "SELECT i.nom AS ingredientNom, c.quantite, un.type AS uniteType
                        FROM contientlive c
                        JOIN ingredient i ON c.idIngredient = i.id
                        JOIN unite un ON i.uniteId = un.id
                        WHERE c.idLive = :idLive";

        $stmt = $this->conn->prepare($ingredientQuery);
        $stmt->bindParam(":idLive", $id, PDO::PARAM_INT);
        $stmt->execute();
        $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Ajouter les ingrédients au tableau du live
        $live['ingredients'] = $ingredients;

        return $live;
    }

    public function getAllLives() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY datePublication DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
