<?php

class kategori
{
    private $conn;


    public function __construct($database)
    {
        $this->conn = $database;
    }

    public function index()
    {
        $q = $this->conn->prepare("
        SELECT * FROM kategori
        WHERE deleted_at IS NULL
        ");

        $q->execute();

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $q = $this->conn->prepare("
    INSERT INTO kategori (
    nama,
    kd_kategori,
    deskripsi
    ) VALUES (
    :nama,
    :kd_kategori, 
    :deskripsi 
    )
    ");

        $q->execute([
            'nama' => $data['nama'],
            'kd_kategori' => $data['kd_kategori'],
            'deskripsi' => $data['deskripsi']
        ]);
    }

    public function edit($data)
    {
        $q = $this->conn->prepare('
        UPDATE kategori SET
        nama = :nama,
        kd_kategori = :kd_kategori,
        deskripsi = :deskripsi
        WHERE id = :id
        ');

        $q->execute($data);
    }

    public function delete($id)
    {
        $q = $this->conn->prepare('
        UPDATE kategori SET
        deleted_at = NOW()
        WHERE id = :id
        ');

        $q->execute([
            'id' => $id
        ]);
    }


    public function checkKategori($id)
    {
        $q = $this->conn->prepare('
        SELECT * FROM kategori
        WHERE id = :id
        AND deleted_at IS NULL
        ');
        $q->execute([
            'id' => $id
        ]);

        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function checkNama($nama)
    {
        $q = $this->conn->prepare("
    SELECT * FROM kategori
    WHERE nama = :nama
    AND deleted_at IS NULL
    ");

        $q->execute([
            'nama' => $nama
        ]);

        return $q->fetch(PDO::FETCH_ASSOC);
    }
}
