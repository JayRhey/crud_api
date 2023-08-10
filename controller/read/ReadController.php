<?php

require_once '../../model/read/ReadModel.php';

class ReadController
{
    private $readModel;

    public function __construct()
    {
        $this->readModel = new ReadModel();
    }

    public function handleRequest()
    {

        $data = $this->readModel->readData();

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

// Instantiate the controller and handle the request
$readController = new ReadController();
$readController->handleRequest();
