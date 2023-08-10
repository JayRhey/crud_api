<?php
error_reporting(E_ALL);

require_once '../../model/read/ModalEditReadModel.php';

class ModalEditController
{
    private $model;

    public function __construct()
    {
        $this->model = new ModalEditModel();
    }

    public function handlePostRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            // Get data from the model for the specific ID
            $data = $this->model->getDataById($id);

            // Send a valid JSON response
            header('Content-Type: application/json');
            echo json_encode($data);
            exit; // Make sure to exit after sending the response
        }
    }





    // Add other functions here for handling update requests or any other operations you need
}

// Instantiate the controller and handle the POST request
$modalEditController = new ModalEditController();
$modalEditController->handlePostRequest();
