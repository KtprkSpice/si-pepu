<?php
require_once __DIR__ . "/../../layout/admin.php";

?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="w-full max-w-6xl p-10">
        <h1 class="text-2xl font-bold mb-10">Data Buku</h1>
        <div class="mb-10">
            <a href="<?= BASE_URL ?>/pages/admin/buku/view/tambah.php" class="px-5 py-2 bg-blue-500 text-white rounded-lg">Tambah Buku</a>
        </div>
        <table id="listBuku" class="display">
            <thead>
                <tr>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Dune</td>
                    <td>Sci-fi</td>
                </tr>
                <tr>
                    <td>Harry Potter</td>
                    <td>Sci-fi</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<script>
    let table = new DataTable('#listBuku');
</script>