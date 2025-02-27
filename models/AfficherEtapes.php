<?php
require_once __DIR__ . '/../config/database.php';

class AfficherEtapes {
    private $conn;
    private $table = "etaperecette";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer les étapes et conseils par ID de recette
    public function getEtapesByRecetteId($idRecette) {
        $query = "SELECT numeroetape, descriptionEtape, Tips 
                  FROM " . $this->table . " 
                  WHERE idRecette = :idRecette 
                  ORDER BY numeroetape";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":idRecette", $idRecette, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
