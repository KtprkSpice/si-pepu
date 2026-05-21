<?php

require_once __DIR__ . "/../../../../config/config.php";

try {
    $qkategori = $conn->prepare("
    SELECT * FROM kategori 
    WHERE deleted_at IS NULL
    ");

    $qkategori->execute();

    $kategori = $qkategori->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION["error"] = $e->getMessage();
    header("Location: ../view/index.php");
    exit();
}
