<?php
require_once __DIR__ . "/../../config/config.php";

if (isset($_POST['login'])) {
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $q = $conn->prepare('
    SELECT id, username, email,password,role
    FROM users
    WHERE email = :email
    ');

        $q->execute([
            'email' => $email,
        ]);

        $users = $q->fetch(PDO::FETCH_ASSOC);

        if ($users) {
            if (password_verify($password, $users['password'])) {
                $_SESSION['user_id'] = $users['id'];
                $_SESSION['username'] = $users['username'];
                $_SESSION['email'] = $users['email'];
                $_SESSION['role'] = $users['role'];
                $_SESSION['success'] = 'Berhasil login';
                header('Location: ../../pages/admin/buku/view/index.php');
                exit();
            } else {
                $_SESSION['error'] = "Email atau Password salah";
                header('Location: login.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Akun tidak ada';
            header('Location: login.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: login.php');
        exit();
    }
}
