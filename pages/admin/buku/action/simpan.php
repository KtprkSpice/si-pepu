<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controller/bukuController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $controller = new bukuController($conn);
    $controller->store($_POST);
}
