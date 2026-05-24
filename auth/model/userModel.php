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
}
