<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controller/bukuController.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $controller = new bukuController($conn);
    $controller->delete($id);
}
