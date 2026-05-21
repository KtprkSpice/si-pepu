<?php
require_once __DIR__ . "/../../layout/admin.php";

$queryKategori = $conn->prepare("
SELECT * FROM kategori
WHERE deleted_at IS NULL
");

$queryKategori->execute();

// FetchAll karena semua data buka satuan
$kategori = $queryKategori->fetchAll(PDO::FETCH_ASSOC);

$id = $_GET["id"];

$qbuku = $conn->prepare("
SELECT * FROM buku
WHERE id = :id
");

$qbuku->execute([
    'id' => $id
]);

$buku = $qbuku->fetch(PDO::FETCH_ASSOC);
?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="border border-black w-full max-w-6xl p-10">
        <h2 class="text-2xl font-bold mb-10">Tambah Buku</h2>
        <form action="<?= BASE_URL ?>/pages/admin/buku/crud/update.php" method="post">
            <!-- ID -->
            <input type="hidden" name="id" value="<?= $buku['id'] ?>">
            <!-- Kategori buku -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="id_kategori">Kategori buku</label>
                <select name="id_kategori" id="id_kategori" class="border border-gray-500 rounded-xl px-2 py-3 outline-none">
                    <option value="">--Pilih Kategori--</option>
                    <?php foreach ($kategori as $item): ?>
                        <option
                            value="<?= $item['id'] ?>"
                            <?= $buku['id_kategori'] == $item['id'] ? 'selected' : '' ?>
                            data-kode=<?= strtoupper($item['kd_kategori']) ?>>
                            <?= $item['nama'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Kode Buku -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="code_buku">Kode Buku</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        readonly
                        type="text"
                        name="code_buku"
                        id="code_buku"
                        class="px-2 py-3 w-full outline-blue-500"
                        value="<?= $buku['code_buku'] ?>">
                </div>
            </div>
            <!-- Nama Buku -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="nama_buku">Nama Buku</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        type="text"
                        name="nama_buku"
                        id="nama_buku"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $buku['nama_buku'] ?>">
                </div>
            </div>
            <!-- Nama Penerbit -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="nama_penerbit">Nama Penerbit</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        type="text"
                        name="nama_penerbit"
                        id="nama_penerbit"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $buku['nama_penerbit'] ?>">
                </div>
            </div>
            <!-- Nama Penulis -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="nama_penulis">Nama Penulis</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        type="text"
                        name="nama_penulis"
                        id="nama_penulis"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $buku['nama_penulis'] ?>">
                </div>
            </div>
            <!-- ISBN -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="isbn">ISBN</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        type="text"
                        name="isbn"
                        id="isbn"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $buku['isbn'] ?>">
                </div>
            </div>
            <!-- Taggal Rilis Buku -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="tgl_rilis_buku">Tanggal Rilis Buku</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        type="date"
                        name="tgl_rilis_buku"
                        id="tgl_rilis_buku"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $buku['tgl_rilis_buku'] ?>">
                </div>
            </div>
            <!-- Taggal Masuk Buku -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="tgl_masuk">Tanggal Masuk Buku</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        type="date"
                        name="tgl_masuk"
                        id="tgl_masuk"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $buku['tgl_masuk'] ?>">
                </div>
            </div>
            <div class="my-10">
                <button type="submit" class="bg-blue-500 px-5 py-2 cursor-pointer shadow-lg text-white hover:bg-blue-900 hover:shadow-xl rounded-lg">Update</button>
            </div>
        </form>
    </div>
</section>