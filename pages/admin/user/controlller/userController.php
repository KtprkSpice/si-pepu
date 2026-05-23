<?php

require_once __DIR__ . "/../model/user.php";

class userController
{
    private $user;

    public function __construct($conn)
    {
        $this->user = new user($conn);
    }

    public function index()
    {
        return $this->user->index();
    }

    public function store($request)
    {
        try {
            $username = $request['username'];
            $email = $request['email'];
            $password = $request['password'];
            $noTelp = $request['no_telp'];
            $konfirmasi_password = $request['konfirmasi_password'];
            $role = $request['role'];

            if ($password != $konfirmasi_password) {
                $_SESSION['error'] = 'Password tidak match';
                header('Location: ../view/tambah.php');
                exit();
            }
            $this->user->insert([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role,
            ]);
            $_SESSION['success'] = 'Berhasil membuat user';
            header('Location: ../view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ../view/tambah.php');
            exit();
        }
    }

    public function update($request)
    {
        try {
            $id = $request['id'];
            $username = $request['username'];
            $email = $request['email'];
            $password = $request['password'];
            $konfirmasi_password = $request['konfirmasi_password'];
            $role = $request['role'];

            if ($password != $konfirmasi_password) {
                $_SESSION['error'] = 'Password tidak match';
                header('Location: ../view/tambah.php');
                exit();
            }

            $this->user->edit([
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => $role,
            ]);
            $_SESSION['success'] = 'Berhasil membuat user';
            header('Location: ../view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../view/edit.php?id=$id");
            exit();
        }
    }

    public function delete($id)
    {
        try {
            $this->user->delete($id);
            $_SESSION['success'] = "data Berhasil dihapus";
            header('Location: ../view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ../view/index.php');
            exit();
        }
    }
}
