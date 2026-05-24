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
            } else {
                header('Location:' . BASE_URL . '/pages/member/buku/view/index.php');
                exit();
            }
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . BASE_URL . '/auth/login/login.php');
            exit();
        }
    }

    public function register($request)
    {
        try {
            $username = $request['username'];
            $email = $request['email'];
            $password = $request['password'];
            $konfirmasi_password = $request['konfirmasi_password'];

            if ($password != $konfirmasi_password) {
                $_SESSION['error'] = "password tidak sama";
                header('Location:' . BASE_URL . '/auth/register/register.php');
                exit();
            }

            if ($this->user->emailCheck) {
                $_SESSION['error'] = 'Email sudah terdaftar';
                header('Location:' . BASE_URL . '/auth/register/register.php');
                exit();
            }

            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $userId =  $this->user->register([
                'username' => $username,
                'email' => $email,
                'password' => $hashPassword,
                'role' => 'member'
            ]);

            $user = $this->user->findById($userId);

            // Auto Login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            $_SESSION['success'] = 'berhasil buat akun';
            header('Location:' . BASE_URL . '/pages/member/buku/view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . BASE_URL . '/auth/register/register/php');
            exit();
        }
    }
}
