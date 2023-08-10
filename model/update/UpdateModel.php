<?php

require_once '../../connection/conn.php';

class UpdateModel
{
    private $db;

    public function __construct()
    {
        // Create a database connection using the DatabaseConnection class
        $dbConnection = new DatabaseConnection();
        $this->db = $dbConnection->getConnection();
    }

    


    public function updateData($id, $fname, $lname, $email, $_address, $cell)
    {
        // Sample insert query, replace with your actual table and column names
        $sql = "UPDATE personal_info SET fname = :fname, lname = :lname, email = :email, _address = :address, cell = :cell WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $_address);
        $stmt->bindParam(':cell', $cell);
        $stmt->execute();

        // Execute the query
        return $stmt->execute();
    }

    // Add more methods as needed for other database operations

    // ...
}
