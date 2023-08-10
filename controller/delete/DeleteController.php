<?php
error_reporting(E_ALL);

require_once '../../model/delete/DeleteModel.php';

class DeleteController
{
    private $model;

    public function __construct()
    {
        $this->model = new DeleteModel();
    }

    public function handlePostRequest()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
         $id = $_POST['id'];
         // Delete data from the model for the specific ID
         if ($this->model->deleteData($id)) {
             $id = $id;
             $response = array('status' => 'success', 'message' => 'Data deleted successfully.', 'id' => $id);
         } else {
             $response = array('status' => 'error', 'message' => 'Error deleting data.');
         }

         // Send a valid JSON response
         header('Content-Type: application/json');
         echo json_encode($response);
         exit; // Make sure to exit after sending the response
     }
    }

    // Add other functions here for handling other delete operations if needed
}
// Instantiate the controller and handle the POST request
$deleteController = new DeleteController();
$deleteController->handlePostRequest();
