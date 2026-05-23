<?php

class buku
{
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database;
    }

    public function index()
    {
        $qBuku = $this->conn->prepare("
 SELECT 
 buku.*,
    kategori.nama as nama_kategori
 FROM buku
    JOIN kategori
        on buku.id_kategori = kategori.id
 WHERE buku.deleted_at IS NULL
");

        $qBuku->execute();

        return $qBuku->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checKBuku($id)
    {
        $q = $this->conn->prepare("
        SELECT * FROM buku
        WHERE id  = :id
        AND deleted_at IS NULL
        ");

        $q->execute([
            'id' => $id
        ]);

        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function getKategoriById($idKategori)
    {
        $query = $this->conn->prepare("
    SELECT * FROM kategori
    WHERE id = :id
    AND deleted_at IS NULL
    ");

        $query->execute([
            'id' => $idKategori
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getOldCodeBuku($id)
    {
        $q = $this->conn->prepare('
        SELECT code_buku
        FROM buku
            WHERE id = :id
        ');

        $q->execute([
            'id' => $id
        ]);

        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function getLastCodeBuku($idKategori)
    {
        $query = $this->conn->prepare('
        SELECT code_buku
        FROM buku
        WHERE code_buku LIKE :kd_kategori
        AND deleted_at IS NULL
        ORDER BY code_buku desc
        LIMIT 1
        ');

        $query->execute([
            'kd_kategori' => $idKategori . '%'
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $query = $this->conn->prepare('
        INSERT INTO buku (
        code_buku,
        nama_buku,
        id_kategori,
        nama_penerbit,
        isbn,
        nama_penulis,
        tgl_rilis_buku,
        tgl_masuk
        ) VALUES (
        :code_buku, 
        :nama_buku, 
        :id_kategori, 
        :nama_penerbit, 
        :isbn, 
        :nama_penulis, 
        :tgl_rilis_buku,
        NOW() 
        )
        ');

        $query->execute([
            "code_buku" => $data['code_buku'],
            "nama_buku" => $data['nama_buku'],
            "id_kategori" => $data['id_kategori'],
            "nama_penerbit" => $data['nama_penerbit'],
            "isbn" => $data['isbn'],
            "nama_penulis" => $data['nama_penulis'],
            "tgl_rilis_buku" => $data['tgl_rilis_buku']
        ]);
    }

    public function edit($data)
    {
        $query = $this->conn->prepare('
     UPDATE buku 
        SET 
            code_buku = :code_buku,
            nama_buku = :nama_buku,
            id_kategori = :id_kategori,
            nama_penerbit = :nama_penerbit,
            isbn = :isbn,
            nama_penulis = :nama_penulis,
            tgl_rilis_buku = :tgl_rilis_buku,
            tgl_masuk = :tgl_masuk
        WHERE id = :id
    ');

        $query->execute($data);
    }

    public function delete($id)
    {
        $q = $this->conn->prepare('
        UPDATE buku
        SET
        deleted_at = NOW()
        WHERE id = :id
        ');

        $q->execute([
            'id' => $id
        ]);
    }
}
