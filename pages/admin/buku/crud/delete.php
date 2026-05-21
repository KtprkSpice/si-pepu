<?php

require_once __DIR__ . "/../../../../config/config.php";

try {
    $id = $_GET['id'];

    $qCheck = $conn->prepare("
 SELECT * FROM buku 
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
        $qDelete = $conn->prepare("
    UPDATE buku SET
    deleted_at = now()
    WHERE id = :id 
    ");

        $qDelete->execute([
            'id' => $id
        ]);

        $_SESSION['success'] = "Berhasil Hapus Data" . " " . $data['code_buku'];
        header('Location: ../view/index.php');
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
    header('Location: ../view/index.php');
    exit();
}
