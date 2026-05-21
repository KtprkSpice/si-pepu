<?php
require_once __DIR__ . "/../../../../config/config.php";

try {
    $id = $_GET["id"];

    $qCheck = $conn->prepare("
    SELECT * FROM kategori
    WHERE id = :id
    ");

    $qCheck->execute([
        'id' => $id
    ]);

    $data = $qCheck->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        $_SESSION['error'] = "Data tidak ada";
        header("Location: ../view/index.php");
        exit();
    } else {
        try {
            // Start Transaction
            $conn->beginTransaction();


            $qDelete = $conn->prepare("
        UPDATE kategori SET
        deleted_at = now()
        WHERE id = :id
        ");

            $qDelete->execute([
                'id' => $id
            ]);

            $qBuku = $conn->prepare('
        UPDATE buku SET
            id_kategori = :default_kategori
        WHERE id_kategori = :id
        ');

            $qBuku->execute([
                'id' => $id,
                'default_kategori' => 4
            ]);


            // Commit
            $conn->commit();

            $_SESSION['success'] = "data Berhasil dihapus";
            header("Location: ../view/index.php");
            exit();
        } catch (PDOException $e) {
            // Rolback
            $conn->rollBack();

            $_SESSION["error"] = $e->getMessage();
            header("Location: ../view/index.php");
            exit();
        }
    }
} catch (PDOException $e) {
    $_SESSION["error"] = $e->getMessage();
    header("Location: ../view/index.php");
    exit();
}
