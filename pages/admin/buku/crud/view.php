<?php

require_once __DIR__ . "/../../../../config/config.php";

try {
    $qBuku = $conn->prepare("
 SELECT 
 buku.*,
    kategori.nama as nama_kategori
 FROM buku
    JOIN kategori
        on buku.id_kategori = kategori.id
 WHERE buku.deleted_at IS NULL
");

    $qBuku->execute();

    $buku = $qBuku->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION["error"] = $e->getMessage();
    header("Location: ../view/index.php");
}
