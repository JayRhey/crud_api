<?php
require_once '../../model/update/UpdateModel.php';

class UpdateController
{
    private $model;

    public function __construct()
    {
        $this->model = new UpdateModel();
    }

    public function handlePostRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming the data to be updated is sent in JSON format
            $inputData = json_decode(file_get_contents('php://input'), true);

            // Validate the input data
            $validationResult = $this->validateData($inputData);
            if ($validationResult['status'] === 'error') {
                // Return the validation error response
                header('Content-Type: application/json');
                echo json_encode($validationResult);
                exit;
            }

            // Sanitize the input data
            $fname = $this->sanitizeName($inputData['fname']);
            $lname = $this->sanitizeName($inputData['lname']);
            $email = $this->sanitizeEmail($inputData['email']);
            $_address = $inputData['_address'];
            $cell = $inputData['cell'];

            // Get the ID from the input data
            $id = $inputData['id'];

            // Call the updateData() method of the Update model to update data in the database
            if ($this->model->updateData($id, $fname, $lname, $email, $_address, $cell)) {
                $id = $id;
                $fname = $fname;
                $lname = $lname;
                $email = $email;
                $_address = $_address;
                $cell = $cell;
                $response = array('status' => 'success', 'message' => 'Data updated successfully.',
                'fname' => $fname, 'lname' => $lname, 'email' => $email, '_address' => $_address, 'cell' => $cell, 'id' => $id);
            } else {
                $response = array('status' => 'error', 'message' => 'Error updating data.');
            }

            // Send a valid JSON response
            header('Content-Type: application/json');
            echo json_encode($response);
            exit; // Make sure to exit after sending the response
        }
    }

    private function validateData($inputData)
    {
        // Validate the first name and last name (does not accept special characters and blank spaces)
        $fname = $inputData['fname'];
        $lname = $inputData['lname'];

        if (!preg_match('/^[a-zA-Z]+$/', $fname) || !preg_match('/^[a-zA-Z]+$/', $lname)) {
            return array('status' => 'error', 'message' => 'First Name and Last Name should only contain letters and no special characters.');
        }

        // Validate the email format
        $email = $inputData['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return array('status' => 'error', 'message' => 'Invalid email format.');
        }

        // No validation errors, return success status
        return array('status' => 'success');
    }

    private function sanitizeName($name)
    {
        // Set the first character of the name to uppercase
        return ucfirst(strtolower($name));
    }

    private function sanitizeEmail($email)
    {
        // Remove any leading/trailing whitespaces and sanitize the email
        return trim(filter_var($email, FILTER_SANITIZE_EMAIL));
    }
}

// Instantiate the controller and handle the POST request
$updateController = new UpdateController();
$updateController->handlePostRequest();
?>
