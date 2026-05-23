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
        ");

        $q->execute();

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        try {
            $this->conn->beginTransaction();

            $q = $this->conn->prepare("
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
        ");

            $q->execute([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role']
            ]);

            $userId = $this->conn->lastInsertId();

            $noMember = "MB" . str_pad($userId, 3, "0", STR_PAD_LEFT);

            $qMember = $this->conn->prepare("
        INSERT INTO member (
        no_member,
        nama,
        email,
        no_telp,
        user_id,
        status,
        masa_aktif
        ) VALUES (
        :no_member, 
        :nama, 
        :email, 
        :no_telp, 
        :user_id, 
        :status, 
        :masa_aktif 
        )
        ");

            $qMember->execute([
                'no_member' => $noMember,
                'nama' => $data['username'],
                'email' => $data['email'],
                'no_telp' => $data['no_telp'],
                'user_id' => $userId,
                'status' => 'aktif',
                'masa_aktif' => date('Y-m-d', strtotime('+1 year'))
            ]);

            $this->conn->commit();
            return true;
        } catch (Throwable $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function insertMember($data)
    {
        $q = $this->conn->prepare("
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
        ");

        $q->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role']
        ]);
    }
}
