<?php
require_once __DIR__ . "/../../../../config/config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        // Request    
        $id = $_POST['id'];
        $idKategori = $_POST['id_kategori'];
        $namaBuku = $_POST['nama_buku'];
        $namaPenerbit = $_POST['nama_penerbit'];
        $namaPenulis = $_POST['nama_penulis'];
        $isbn = $_POST['isbn'];
        $tgl_rilis_buku = $_POST['tgl_rilis_buku'];
        $tgl_masuk = $_POST['tgl_masuk'];

        // query Ambil Kategori
        $qKategori = $conn->prepare('
    SELECT * FROM kategori
    WHERE id = :id
    ');

        // ambil data kategori berdasarkan id yang di form
        $qKategori->execute([
            'id' => $idKategori
        ]);

        // Ambil data kategori
        $kategori = $qKategori->fetch(PDO::FETCH_ASSOC);

        // Pengecekan Kategori
        if (!$kategori) {
            $_SESSION['error'] = 'Kategori tidak boleh kosong';
            header("Location: ../view/edit.php?id=$id");
            exit();
        }

        // Kode Kategori
        $kdKategori = strtoupper($kategori["kd_kategori"]);

        // Ambil kode buku lama
        $qOldCode = $conn->prepare("
        SELECT code_buku
        FROM buku
        WHERE id = :id
        ");

        $qOldCode->execute([
            "id" => $id
        ]);

        $oldCode = $qOldCode->fetch(PDO::FETCH_ASSOC);

        $oldNumber = substr($oldCode['code_buku'], 2);

        $kodebuku = $kdKategori . $oldNumber;

        // Update Value
        $qInsertBook = $conn->prepare('
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

        $qInsertBook->execute([
            'id' => $id,
            'code_buku' => $kodebuku,
            'nama_buku' => $namaBuku,
            'id_kategori' => $idKategori,
            'nama_penerbit' => $namaPenerbit,
            'nama_penulis' => $namaPenulis,
            'isbn' => $isbn,
            'tgl_rilis_buku' => $tgl_rilis_buku,
            'tgl_masuk' => $tgl_masuk
        ]);

        $_SESSION['success'] = "Berhasil Update data";
        header("Location: ../view/index.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../view/edit.php?id=$id");
        exit();
    }
}
