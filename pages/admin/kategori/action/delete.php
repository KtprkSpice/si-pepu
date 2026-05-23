<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controller/kategoriController.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new KategoriController($conn);
    $controller->delete($id);
}
