<?php

require_once __DIR__ . "/../../../../config/config.php";

$qBuku = $conn->prepare("
 SELECT 
 buku.*,
    kategori.nama as nama_kategori
 FROM buku
    JOIN kategori
        on buku.id_kategori = kategori.id
");

$qBuku->execute();

$buku = $qBuku->fetchAll(PDO::FETCH_ASSOC);
