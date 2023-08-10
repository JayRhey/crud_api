<?php
require_once '../../connection/conn.php';

class ModalEditModel
{
    private $db;

    public function __construct()
    {
        // Create a database connection using the DatabaseConnection class
        $dbConnection = new DatabaseConnection();
        $this->db = $dbConnection->getConnection();
    }

    public function getDataById($id)
    {
        $sql = "SELECT * FROM personal_info WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




}
