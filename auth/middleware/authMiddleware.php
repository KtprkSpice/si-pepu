<?php

class authMiddleware
{
    public static function check($roles = [])
    {
        // Belum login
        if (!$_SESSION['user_id']) {
            $_SESSION['error'] = 'Harap login terlebih dahulu';
            header('Location:' . BASE_URL . '/auth/login/login.php');
            exit();
        }

        if (empty($roles)) {
            return;
        }

        if (!in_array($_SESSION['role'], $roles)) {
            $_SESSION['error'] = 'Akses ditolak';
            header('Location:' . BASE_URL . '/pages/index.php');
            exit();
        }
    }
}
