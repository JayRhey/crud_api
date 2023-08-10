<?php

require_once '../../connection/conn.php';

class ReadModel
{
    private $db;

    public function __construct()
    {
        // Create a database connection using the DatabaseConnection class
        $dbConnection = new DatabaseConnection();
        $this->db = $dbConnection->getConnection();
    }

    public function readData()
    {

        $sql = "SELECT * FROM personal_info";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add more methods as needed for other read operations

    // ...
}
