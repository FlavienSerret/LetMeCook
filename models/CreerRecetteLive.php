<?php
require_once __DIR__ . '/../config/database.php';

class CreerRecetteLive {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function ajouterRecetteLive($titre, $idDifficulte, $heureDebut, $duree, $lienYoutube) {
        $query = "INSERT INTO recette_live (idUser, titre, idDifficulte, heureDebut, duree, lienYoutube) 
                  VALUES (1, :titre, :idDifficulte, :heureDebut, :duree, :lienYoutube)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':titre' => $titre,
            ':idDifficulte' => $idDifficulte,
            ':heureDebut' => $heureDebut,
            ':duree' => $duree,
            ':lienYoutube' => $lienYoutube
        ]);
        return $this->conn->lastInsertId();
    }
}
?>
