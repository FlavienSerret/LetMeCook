<?php
require_once __DIR__ . '/../config/database.php';

class CreerRecette {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllIngredients() {
        $query = "SELECT * FROM ingredient";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUnites() {
        $query = "SELECT * FROM unite";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterRecette($idUser, $titre, $nbPersonnes, $idDifficulte, $calories, $photoPath) {
        $query = "INSERT INTO recette (idUser, titre, nombreDePersonne, idDifficulte, calories, cheminPhoto) 
                  VALUES (:idUser, :titre, :nbPersonnes, :idDifficulte, :calories, :photo)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':idUser' => $idUser,
            ':titre' => $titre,
            ':nbPersonnes' => $nbPersonnes,
            ':idDifficulte' => $idDifficulte,
            ':calories' => $calories,
            ':photo' => $photoPath
        ]);
        return $this->conn->lastInsertId();
    }

    public function ajouterIngredient($idRecette, $idIngredient, $quantite) {
        $query = "INSERT INTO contientrecette (idRecette, idIngredient, quantite) 
                  VALUES (:idRecette, :idIngredient, :quantite)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':idRecette' => $idRecette,
            ':idIngredient' => $idIngredient,
            ':quantite' => $quantite,
        ]);
    }


}
?>
