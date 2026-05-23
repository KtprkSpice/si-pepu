<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controller/kategoriController.php";

if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
    $controller = new KategoriController($conn);
    $controller->store($_POST);
}
