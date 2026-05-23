<?php

class user
{
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database;
    }

    public function index()
    {
        $q = $this->conn->prepare("
        SELECT * FROM users 
        WHERE deleted_at IS NULL
        AND role != 'member'
        ");

        $q->execute();

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }


    public function insert($data)
    {
        $q = $this->conn->prepare("
        INSERT INTO users (
        username,
        email,
        no_telp,
        password,
        role
        ) VALUES (
        :username,
        :email,
        :no_telp,
        :password,
        :role
        )
        ");

        $q->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role']
        ]);
    }


    public function edit($data)
    {
        $q = $this->conn->prepare("
        UPDATE users SET 
            username = :username,
            email = :email,
            password = :password,
            role = :role 
        WHERE id = :id
        ");

        $q->execute($data);
    }

    public function delete($id)
    {
        $q = $this->conn->prepare("
        UPDATE users SET
            deleted_at = NOW()
        WHERE id = :id
        ");

        $q->execute([
            "id" => $id
        ]);
    }
}
