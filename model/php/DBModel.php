<?php

/**
 * Example class for handling database connection and requests.
 * The class has very few implemented methods since it is just meant to introduce an example
 * 
 * @author William Delamare
 * @created Dec. 2023
 */
class DBModel {
    
    public $conn; // connection object

    // initialize the database connection in the constructor
    public function __construct() {
        // include the settings file
        require __DIR__ . '/env_settings.php';
        try {
            $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $user, $pwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
            // if we are here, $this->conn is null
            // to simplify the code for the next examples, we will stop the execution here
            die();
        }
    }

    public function get_connection() {
        return $this->conn;
    }

    public function close_connection() {
        $this->conn = null;
    }


    // other useful methods to interact with the database
    // AND that are common to all models
    // should be implemented here


}

