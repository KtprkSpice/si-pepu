<?php

require_once __DIR__ . "/../model/user.php";

class userController
{
    private $kategori;

    public function __construct($conn)
    {
        $this->kategori = new user($conn);
    }

    public function index()
    {
        return $this->kategori->index();
    }
}
