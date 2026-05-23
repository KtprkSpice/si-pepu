<?php
require_once __DIR__ . '/../../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $konfirmasi_password = $_POST['konfirmasi_password'];
        $role = $_POST['role'];

        if ($password != $konfirmasi_password) {
            $_SESSION['error'] = "password tidak match";
            header("Location: ../view/edit.php");
            exit();
        }

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $q = $conn->prepare("
        UPDATE users SET 
            username = :username,
            email = :email,
            password = :password,
            role = :role
        WHERE id = :id
        ");

        $q->execute([
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'password' => $hashPassword,
            'role' => $role,
        ]);


        $_SESSION['success'] = 'Berhasil Update akun';
        header('Location: ../view/index.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../view/edit.php');
        exit();
    }
}
