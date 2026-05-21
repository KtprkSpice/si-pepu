<?php

require_once __DIR__ . "/../../config/config.php";

if (isset($_POST["register"])) {
    try {
        // Request
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['konfirmasi_password'];

        // Check if password and pasword confimation samae
        if ($password != $confirm) {
            $_SESSION['error'] = "password tidak sama";
            header("Location: register.php");
            exit();
        }

        // slect user base on email
        $check = $conn->prepare("
        SELECT id FROM users WHERE email = :email
        ");

        $check->execute([
            'email' => $email
        ]);

        // check if user email already registered
        if ($check->fetch()) {
            $_SESSION['error'] = 'Email sudah terdaftar';
            header('Location: register.php');
            exit();
        }

        // hash password
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // insert
        $q = $conn->prepare("
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
        ");

        $q->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashPassword,
            'role' => 'member'
        ]);

        $userId = $conn->lastInsertId();

        // Ambil data yang sudah di insert
        $qUser = $conn->prepare('
        SELECT * FROM users where id = :id
        ');

        $qUser->execute([
            'id' => $userId
        ]);

        $user = $qUser->fetch(PDO::FETCH_ASSOC);

        // auto login
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        $_SESSION['success'] = 'Berhasil membuat akun';
        header('Location: ../../pages/admin/buku/view/index.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: register.php');
        exit();
    }
}
