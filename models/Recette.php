<?php
require_once __DIR__ . '/../config/database.php';

class Recette {
    private $conn;
    private $table = "recette";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getRecetteById($id) {
        $query = "SELECT r.*, u.nom AS nomChef FROM " . $this->table . " r 
                  JOIN user u ON r.idUser = u.id
                  WHERE r.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAverageRating($idRecette) {
        $query = "SELECT AVG(note) AS moyenne FROM noterecette WHERE idRecette = :idRecette";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idRecette", $idRecette, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['moyenne'] ? round($result['moyenne'], 1) : 0;  // Retourne la moyenne arrondie à 1 décimale
    }

    // Dans Recette.php
    public function getRecetteByUserId($idUser) {
        $query = "SELECT r.*, u.nom AS nomChef FROM " . $this->table . " r
              JOIN user u ON r.idUser = u.id
              WHERE r.idUser = :idUser";  // Changer :id par :idUser pour récupérer toutes les recettes d'un utilisateur

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);  // Utilise l'idUser pour lier
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Récupère toutes les recettes
    }

}



?>
