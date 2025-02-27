<?php
// User.php

require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Vérifie si l'utilisateur est un chef
    public function isChef($userId) {
        $query = "SELECT type FROM user WHERE id = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['type'] == 1;  // On retourne true si l'utilisateur est un chef
    }
}
?>