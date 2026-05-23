<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controlller/userController.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new userController($conn);
    $controller->delete($id);
}
