<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../model/peminjaman.php";
require_once __DIR__ . "/../controller/peminjamanController.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $model = new peminjamanModel($conn);
    $controller = new peminjamanController($model);
    $controller->delete($id);
}
