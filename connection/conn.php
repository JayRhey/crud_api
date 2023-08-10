<?php

require_once 'config.php';
class DatabaseConnection
{
    private $db;

    public function __construct()
    {
        // Create a database connection using the defined constants
        try {
            $this->db = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USERNAME,
                DB_PASSWORD,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (PDOException $e) {
            // Handle any errors during the database connection
            error_log('Database Connection Error: ' . $e->getMessage());
            die('Database Connection Error: ' . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->db;
    }
}
