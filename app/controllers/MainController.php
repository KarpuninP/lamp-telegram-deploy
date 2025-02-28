<?php

require_once '../app/models/JsonModel.php';

class MainController
{
    public function index()
    {
        $jsonModel = new JsonModel();
        $data = $jsonModel->getData();

        require_once '../app/views/landing.php';
    }
}
