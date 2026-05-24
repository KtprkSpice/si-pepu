<?php

class userModel
{
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database;
        // var_dump($this->conn);
        // die;
    }

    public function login($email)
    {
        $q = $this->conn->prepare("
            SELECT id, email, username, password, role
            FROM users
            WHERE email = :email
            AND deleted_at IS NULL
        ");

        $q->execute([
            'email' => $email
        ]);

        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function emailCheck($email)
    {
        $q = $this->conn->prepare('
        SELECT * FROM users
        WHERE email = :emai;
        ');

        $q->execute([
            'email' => $email
        ]);

        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function register($data)
    {
        $q = $this->conn->prepare('
        INSERT INTO users (
        username,
        email,
        password,
        role
        ) VALUES (
        :username,
        :email,
        :password,
        :role 
        )
        ');

        $q->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role']
        ]);
    }

    public function findById($id)
    {
        $q = $this->conn->prepare('
        SELECT * FROM users WHERE id = :id
        ');

        $q->execute([
            'id' => $id
        ]);

        return $q->fetch(PDO::FETCH_ASSOC);
    }
}
