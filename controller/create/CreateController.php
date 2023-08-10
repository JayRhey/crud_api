<?php

require_once '../../model/create/CreateModel.php';

class CreateController
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new CreateModel();
    }

    public function handlePostRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming the data to be inserted is sent in JSON format
            $inputData = json_decode(file_get_contents('php://input'), true);

            // Validate and sanitize the input data
            $fname = $this->validateAndSanitizeName(ucfirst($inputData['fname']));
            $lname = $this->validateAndSanitizeName(ucfirst($inputData['lname']));
            $email = $this->validateAndSanitizeEmail($inputData['email']);
            $_address = trim($inputData['_address']);
            $cell = $inputData['cell'];

            // Check for validation errors
            $validationErrors = array();
            if (!$this->isValidName($fname)) {
                $validationErrors[] = 'First Name should only contain letters and no special characters or spaces.';
            }
            if (!$this->isValidName($lname)) {
                $validationErrors[] = 'Last Name should only contain letters and no special characters or spaces.';
            }
            if (!$this->isValidEmail($email)) {
                $validationErrors[] = 'Invalid email format.';
            }


            if (!empty($validationErrors)) {
                $response = array('status' => 'error', 'message' => implode('<br>', $validationErrors));
            } else {

                if ($this->postModel->insertData($fname, $lname, $email, $_address, $cell)) {

                   $lastInsertId = $this->postModel->getLastInsertId();

                    $newRow = '<tr id="row_'.$lastInsertId.'">' .
                        '<td class="fname_td">' . $fname . '</td>' .
                        '<td class="lname_td">' . $lname . '</td>' .
                        '<td class="cell_td">' . $cell . '</td>' .
                        '<td class="address_td">' . $_address . '</td>' .
                        '<td class="email_td">' . $email . '</td>' .
                        '<td>' . '<a class="update_form waves-effect waves-light btn-small modal-trigger" href="#modal_edit" data-id='.$lastInsertId.'>Edit</a><a class="waves-effect waves-light btn-small delete_form" data-id='.$lastInsertId.'>Delete</a>' . '</td>' .
                        '</tr>';

                    $response = array('status' => 'success', 'message' => 'Data inserted successfully.', 'newRow' => $newRow);
                } else {
                    $response = array('status' => 'error', 'message' => 'Error inserting data.');
                }
            }


            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    private function isValidName($name)
    {
        return preg_match('/^[A-Za-z]+$/', $name);
    }

    private function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    private function validateAndSanitizeName($name)
    {
        // Remove leading and trailing spaces
        $name = trim($name);
        // Set first character to uppercase
        return $name;
    }

    private function validateAndSanitizeEmail($email)
    {
        // Remove leading and trailing spaces
        $email = trim($email);
        return $email;
    }
}

// Instantiate the controller and handle the POST request
$createController = new CreateController();
$createController->handlePostRequest();
?>
