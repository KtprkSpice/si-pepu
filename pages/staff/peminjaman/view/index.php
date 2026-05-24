<?php
require_once __DIR__ . "/../../layout/staff.php";
require_once __DIR__ . "/../action/show.php";
?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="w-full max-w-6xl p-10">
        <h1 class="text-2xl font-bold mb-10">Data Pinjaman</h1>
        <div class="mb-10">
            <a href="<?= BASE_URL ?>/pages/staff/peminjaman/view/tambah.php" class="px-5 py-2 bg-blue-500 text-white rounded-lg">Tambah Peminjaman</a>
        </div>
        <table id="listKategori" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Buku</th>
                    <th>Tanggal pinjaman</th>
                    <th>Tenggat Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($pinjaman as $item):
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= ucwords($item['username']) ?></td>
                        <td><?= ucwords($item['nama_buku']) ?></td>
                        <td><?= date('d M Y', strtotime($item['tanggal_pinjam'])) ?></td>
                        <td><?= date('d M Y', strtotime($item['tenggat_waktu'])) ?></td>
                        <td><?= ucwords($item['status']) ?></td>
                        <td>
                            <div class="flex items-center gap-2 justify-center">
                                <a href="<?= BASE_URL ?>/pages/staff/peminjaman/action/kembalikan.php?id=<?= $item['id'] ?>" class="p-1 w-8 bg-blue-500 text-white rounded-lg">
                                    <i class="fa-solid fa-check"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/pages/staff/peminjaman/view/edit.php?id=<?= $item['id'] ?>" class="p-1 w-8 bg-yellow-500 text-white rounded-lg">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <?php if ($item['status'] != 'dikembalikan'): ?>
                                    <a href="<?= BASE_URL ?>/pages/staff/peminjaman/action/delete.php?id=<?= $item['id'] ?>" class="p-1 w-8 bg-red-500 text-white rounded-lg">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    let table = new DataTable('#listKategori');
</script>