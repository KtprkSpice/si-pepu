<?php

class peminjamanModel
{
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database;
    }


    public function insert($data)
    {
        $q = $this->conn->prepare("
        INSERT INTO pinjaman (
        id_member,
        id_buku,
        tanggal_pinjam,
        tenggat_waktu,
        status,
        total_denda
        ) VALUES (
        :id_member, 
        :id_buku, 
        :tanggal_pinjam, 
        :tenggat_waktu, 
        :status, 
        :total_denda 
        )
        ");

        $q->execute([
            'id_member' => $data['id_member'],
            'id_buku' => $data['id_buku'],
            'tanggal_pinjam' => $data['tanggal_pinjam'],
            'tenggat_waktu' => $data['tenggat_waktu'],
            'status' => $data['status'],
            'total_denda' => $data['total_denda']
        ]);
    }

    public function edit($data)
    {
        $q = $this->conn->prepare('
        UPDATE pinjaman SET
            id_member = :id_member, 
            id_buku = :id_buku, 
            tanggal_pinjam = :tanggal_pinjam, 
            tenggat_waktu = :tenggat_waktu
        WHERE id = :id
        ');

        $q->execute([
            'id' => $data['id'],
            'id_member' => $data['id_member'],
            'id_buku' => $data['id_buku'],
            'tanggal_pinjam' => $data['tanggal_pinjam'],
            'tenggat_waktu' => $data['tenggat_waktu']
        ]);
    }

    public function delete($id)
    {
        $q = $this->conn->prepare('
        UPDATE pinjaman SET
            deleted_at = NOW()
        WHERE id = :id
        ');

        $q->execute([
            'id' => $id
        ]);
    }


    public function dataPinjaman()
    {
        $q = $this->conn->prepare("
        SELECT
            pinjaman.*,
            users.username,
            buku.nama_buku
        FROM pinjaman 
            JOIN users
                ON id_member = users.id
            JOIN buku
                ON id_buku = buku.id
        WHERE pinjaman.deleted_at IS NULL
        ");

        $q->execute();

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMember()
    {
        $q = $this->conn->prepare("
        SELECT * FROM users
        WHERE role = :role
        AND deleted_at IS NULL
        ");

        $q->execute([
            'role' => 'member'
        ]);

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBuku()
    {
        $q = $this->conn->prepare("
        SELECT * FROM buku
        WHERE stock > 0
        AND deleted_at IS NULL
        ");
        $q->execute();

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $q = $this->conn->prepare("
        SELECT * FROM pinjaman
        WHERE id = :id
        AND deleted_at IS NULL
        ");

        $q->execute([
            "id" => $id
        ]);

        return $q->fetch(PDO::FETCH_ASSOC);
    }

    public function kurangiStock($id)
    {
        $q = $this->conn->prepare("
        UPDATE buku SET
        stock = stock - 1
        WHERE id = :id
        AND deleted_at IS NULL
        ");

        $q->execute([
            'id' => $id
        ]);
    }

    public function updateBuku($id)
    {
        $q = $this->conn->prepare('
        UPDATE buku SET
        stock = stock + 1
        WHERE id  = :id
        ');

        $q->execute([
            'id' => $id
        ]);
    }

    public function updatePengembalian($data)
    {
        $q = $this->conn->prepare('
        UPDATE pinjaman SET
            status = :status,
            total_denda = :total_denda
        WHERE id = :id
        ');

        $q->execute([
            'id' => $data['id'],
            'status' => $data['status'],
            'total_denda' => $data['total_denda']
        ]);
    }
}
