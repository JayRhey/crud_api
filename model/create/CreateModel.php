<?php

require_once '../../connection/conn.php';

class CreateModel
{
    private $db;

    public function __construct()
    {
        // Create a database connection using the DatabaseConnection class
        $dbConnection = new DatabaseConnection();
        $this->db = $dbConnection->getConnection();
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function insertData($fname, $lname, $email, $_address, $cell)
    {
        // Sample insert query, replace with your actual table and column names
        $sql = "INSERT INTO personal_info (fname, lname, email, _address, cell) VALUES (:fname, :lname, :email, :_address, :cell)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':_address', $_address);
        $stmt->bindParam(':cell', $cell);

        // Execute the query
        return $stmt->execute();
    }

    // Add more methods as needed for other database operations

    // ...
}
