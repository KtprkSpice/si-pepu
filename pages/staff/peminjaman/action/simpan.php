<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../model/peminjaman.php";
require_once __DIR__ . "/../controller/peminjamanController.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = new peminjamanModel($conn);
    $controller = new peminjamanController($model);
    $controller->create($_POST);
}
