<?php
require_once __DIR__ . "/../../layout/admin.php";
require_once __DIR__ . "/../crud/view.php";
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
                    <th>No</th>
                    <th>Code Buku</th>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($buku as $items):
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= strtoupper($items['code_buku']) ?></td>
                        <td><?= ucwords($items['nama_buku']) ?></td>
                        <td><?= ucwords($items['nama_kategori']) ?></td>
                        <td><?= date('d M Y', strtotime($items['tgl_masuk'])) ?></td>
                        <td>
                            <div class="flex items-center gap-2 justify-center">
                                <a href="<?= BASE_URL ?>/pages/admin/buku/view/edit.php?id=<?= $items['id'] ?>" class="p-1 w-8 bg-yellow-500 text-white rounded-lg">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/pages/admin/buku/crud/delete.php?id=<?= $items['id'] ?>" class="p-1 w-8 bg-red-500 text-white rounded-lg">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    let table = new DataTable('#listBuku');
</script>