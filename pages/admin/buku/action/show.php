<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controller/bukuController.php";

$controller = new bukuController($conn);

$buku = $controller->view();
