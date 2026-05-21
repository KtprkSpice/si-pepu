<?php
require_once __DIR__ . "/../../../../config/config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $kdKategori = $_POST['kd_kategori'];
        $deskripsi = $_POST['deskripsi'];

        $qKategori = $conn->prepare("
        UPDATE kategori SET
            nama = :nama,
            kd_kategori = :kd_kategori,
            deskripsi = :deskripsi
        WHERE id = :id
        ");

        $qKategori->execute([
            'id' => $id,
            'nama' => $nama,
            'kd_kategori' => $kdKategori,
            'deskripsi' => $deskripsi
        ]);

        $_SESSION['success'] = "Data " . $nama . " dengan " . $kdKategori . " telah berhasil diupdate";
        header('Location: ../view/index.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../view/edit.php?id=$id");
        exit();
    }
}
