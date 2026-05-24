<?php
class userController
{
    private $user;
    public function __construct($userModel)
    {
        $this->user = $userModel;
    }

    public function login($request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];

            $users = $this->user->login($email);

            if (!$users) {
                $_SESSION['error'] = 'Akun tidak ada';
                header('Location:' . BASE_URL . '/auth/login/login.php');
                exit();
            }

            if (!password_verify($password, $users['password'])) {
                $_SESSION['error'] = 'Password salah';
                header('Location:' . BASE_URL . '/auth/login/login.php');
                exit();
            }

            $_SESSION['user_id'] = $users['id'];
            $_SESSION['username'] = $users['username'];
            $_SESSION['email'] = $users['email'];
            $_SESSION['role'] = $users['role'];

            $_SESSION['success'] = 'Berhasil login';

            if ($users['role'] == 'admin') {
                header('Location:' . BASE_URL . '/pages/admin/buku/view/index.php');
                exit();
            } else if ($users['role'] == 'staff') {
                header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
                exit();
            }
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . BASE_URL . '/auth/login/login.php');
            exit();
        }
    }
}
