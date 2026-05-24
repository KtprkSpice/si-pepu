<?php

require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . "/../controller/userController.php";
require_once __DIR__ . '/../model/userModel.php';

$user = new userModel($conn);
$auth = new userController($user);

if (isset($_POST['login'])) {
    $auth->login($_POST);
}
