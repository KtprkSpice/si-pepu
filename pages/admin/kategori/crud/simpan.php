<?php
require_once __DIR__ . "/../../../../config/config.php";

if (isset($_SERVER['REQUEST_METHOD']) == "POST") {
    try {
        // Request
        $nama = $_POST['nama'];
        $kdKategori = $_POST['kd_kategori'];
        $deskripsi = $_POST['deskripsi'];

        $qkategori = $conn->prepare('
    INSERT INTO kategori (
    nama,
    kd_kategori,
    deskripsi
    )
    VALUES (
    :nama,
    :kd_kategori,
    :deskripsi
    )
    ');

        $qkategori->execute([
            'nama' => $nama,
            'kd_kategori' => $kdKategori,
            'deskripsi' => $deskripsi
        ]);

        $_SESSION['success'] = 'Berhasil tambah kategori';
        header('Location: ../view/index.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../view/tambah.php');
        exit();
    }
}
