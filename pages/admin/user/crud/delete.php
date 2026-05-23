<?php
require_once __DIR__ . "/../../../../config/config.php";

try {
    $id = $_GET["id"];

    $qCheck = $conn->prepare("
SELECT * FROM users 
WHERE id = :id
");

    $qCheck->execute([
        'id' => $id
    ]);

    $data = $qCheck->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        $_SESSION['error'] = "Data tidak ada";
        header("Location: ../view/index/php");
        exit();
    } else {
        try {
            $conn->beginTransaction();

            $qDelete = $conn->prepare("
        UPDATE users SET
            deleted_at = now()
        WHERE id  = :id
        ");

            $qDelete->execute([
                "id" => $id
            ]);

            $conn->commit();

            $_SESSION["success"] = "Berhasil delete data";
            header("Location: ../view/index.php");
            exit();
        } catch (PDOException $e) {
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
