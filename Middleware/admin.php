<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . '/auth/login/login.php');
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header('Location: ' . BASE_URL . '/pages/errors/error.php?code=403');
    exit();
}
