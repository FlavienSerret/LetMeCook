<?php
// models/User.php

require_once __DIR__ . '/../config/database.php';

class User {
    private $conn;
    private $table = "user";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Méthode pour la connexion
    public function login($email, $password)
    {
        // Requête SQL pour récupérer l'utilisateur en fonction de l'email
        $query = "SELECT * FROM " . $this->table . " WHERE mail = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // Récupérer l'utilisateur si trouvé
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si un utilisateur a été trouvé, vérifier le mot de passe
        if ($user && password_verify($password, $user['mdp'])) {
            return $user;
        } else {
            return false; // Mot de passe incorrect ou utilisateur non trouvé
        }
    }

    // Méthode pour vérifier si l'email existe déjà
    public function checkEmailExists($email) {
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE mail = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0; // Si un utilisateur avec cet email existe déjà, retourne true
    }

    // Méthode pour l'enregistrement d'un nouvel utilisateur
    public function register($nom, $prenom, $email, $password, $type) {
        // Hachage du mot de passe pour plus de sécurité
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Conversion du type en 1 ou 0
        $type = ($type === 'cuisinier') ? 1 : 0;

        // Préparation de la requête d'insertion
        $query = "INSERT INTO " . $this->table . " (nom, prenom, mail, mdp, type) VALUES (:nom, :prenom, :email, :password, :type)";
        $stmt = $this->conn->prepare($query);

        // Lier les paramètres
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":type", $type);

        // Exécution de la requête
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
