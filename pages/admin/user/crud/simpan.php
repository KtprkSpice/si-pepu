<?php
require_once __DIR__ . '/../../../../config/config.php';

try {
    if (isset($_SERVER['REQUEST_METHOD']) == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $konfirmasi_password = $_POST['konfirmasi_password'];
        $role = $_POST['role'];

        if ($password !== $konfirmasi_password) {
            $_SESSION['error'] = "password tidak match";
            header('Location: ../view/tambah.php');
            exit();
        }

        // lakukan pengecekan
        $qCheck = $conn->prepare('
        SELECT * FROM users
        WHERE email = :email
        ');

        $qCheck->execute([
            'email' => $email
        ]);

        if ($qCheck->fetch()) {
            $_SESSION['error'] = 'Email sudah terdaftar';
            header('Location: ../view/tambah.php');
            exit();
        }

        // Create User
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $q = $conn->prepare('
        INSERT INTO users (
        username,
        email,
        password,
        role
        )
        VALUES (
        :username,
        :email,
        :password,
        :role
        )
        ');

        $q->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashPassword,
            'role' => $role
        ]);

        $_SESSION['success'] = 'Berhasil Membuat User';
        header('Location: ../view/index.php');
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
    header('Location: ../view/tambah.php');
    exit();
}
