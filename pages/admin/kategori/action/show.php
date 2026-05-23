<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controller./kategoriController.php";

$controller = new KategoriController($conn);

$kategori = $controller->index();
