<?php

require_once __DIR__ . "/../../../../config/config.php";
require_once __DIR__ . "/../controlller/userController.php";

$controller = new userController($conn);
$users = $controller->index();
