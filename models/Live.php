<?php
// models/Live.php

require_once __DIR__ . '/../config/database.php';

class Live {
    private $conn;
    private $table = "live";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Récupérer tous les lives triés par heure de début
    // models/Live.php

    public function getAll() {
        $query = "SELECT * FROM live ORDER BY heureDebut DESC"; // Ou tout autre critère que tu souhaites
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
