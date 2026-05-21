<?php
require_once __DIR__ . "/../../../../config/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        // Request
        $idKategori = $_POST['id_kategori'];
        $namaBuku = $_POST['nama_buku'];
        $namaPenerbit = $_POST['nama_penerbit'];
        $namaPenulis = $_POST['nama_penulis'];
        $isbn = $_POST['isbn'];
        $tgl_rilis_buku = $_POST['tgl_rilis_buku'];

        // query Ambil Kategori
        $queryKategori = $conn->prepare("
    SELECT * FROM kategori
    WHERE id = :id
    ");

        // ambil data kategori berdasarkan id yang di form
        $queryKategori->execute([
            "id" => $idKategori
        ]);

        // Ambil data kategori
        $kategori = $queryKategori->fetch(PDO::FETCH_ASSOC);

        // Pengecekan apakah kategori ada
        if (!$kategori) {
            $_SESSION['error'] = 'Harap isi kategori';
            header('Location: ../view/tambah.php');
            exit();
        }

        // Ambil kd kategori lalu jadikan UPPERCASE
        $kdKategori = strtoupper($kategori['kd_kategori']);

        // Ambil kode buku berdasarkan kategori ambil paling baru karena desc paling atas paling baru
        $querryKodeKategori = $conn->prepare("
    SELECT code_buku
    FROM Buku
    WHERE code_buku LIKE :kd_kategori
    ORDER BY code_buku DESC
    LIMIT 1 
    ");

        $querryKodeKategori->execute([
            'kd_kategori' => $kdKategori . '%'
        ]);

        $lastBook = $querryKodeKategori->fetch(PDO::FETCH_ASSOC);

        // Penambahan nomor di buku terakhir
        if ($lastBook) {
            $lastNumber = (int) substr($lastBook["code_buku"], 2);

            $newNumber  = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // mengkombinasikan code kategori dengan nomor yang baru jadi contoh BK003 bk = $newNumber = misalakan = 3. contoh jadi 003 karena 3 digit dengan string 0 = angka tambahan trd pad left berarti karena 3 adalah new number string "0" berfungsi sebagai nambahin angka 00 sebelum 3  
        $codeBuku = $kdKategori . str_pad($newNumber, 3, "0", STR_PAD_LEFT);

        // Query untuk insert buku
        $queryInsertBook = $conn->prepare("
    INSERT INTO buku (
    code_buku,
    nama_buku,
    id_kategori,
    nama_penerbit,
    isbn,
    nama_penulis,
    tgl_rilis_buku,
    tgl_masuk
    )
    VALUES (
    :code_buku,
    :nama_buku,
    :id_kategori,
    :nama_penerbit,
    :isbn,
    :nama_penulis,
    :tgl_rilis_buku,
    NOW()
    )
    ");

        // Insert buku berdasarkan data yang sudah di definisikan di awal denga $_POST atau dari form
        $queryInsertBook->execute([
            'code_buku' => $codeBuku,
            'nama_buku' => $namaBuku,
            'id_kategori' => $idKategori,
            'nama_penerbit' => $namaPenerbit,
            'nama_penulis' => $namaPenulis,
            'isbn' => $isbn,
            'tgl_rilis_buku' => $tgl_rilis_buku
        ]);

        $_SESSION['success'] = 'Berhasil memasukan data';
        header('Location: ../view/index.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../view/tambah.php');
        exit();
    }
}
