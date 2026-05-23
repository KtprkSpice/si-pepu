<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controlller/userController.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new userController($conn);
    $controller->store($_POST);
}
