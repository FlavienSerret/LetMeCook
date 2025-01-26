<?php
// config/database.php

class Database {
    private $host = "localhost";
    private $db_name = "letmecook";
    private $username = "root"; // Change en fonction de ta configuration
    private $password = "";     // Change en fonction de ta configuration
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
