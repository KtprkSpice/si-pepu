<?php

require_once __DIR__ . '/../../../../config/config.php';

try {
    $qUser = $conn->prepare('
    SELECT * FROM users
    WHERE deleted_at IS NULL
    ');

    $qUser->execute();

    $users = $qUser->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
    header('Location: ../view/show.php');
    exit();
}
