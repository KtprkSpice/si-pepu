<?php
require_once __DIR__ . "/../../layout/staff.php";

require_once __DIR__ . "/../model/peminjaman.php";

$data = new peminjamanModel($conn);
$id = $_GET["id"];
$old = $data->getById($id);
$member = $data->getAllMember();
$buku = $data->getAllBuku();

?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="border border-black w-full max-w-6xl p-10">
        <h2 class="text-2xl font-bold mb-10">Edit Pinjaman</h2>
        <form action="<?= BASE_URL ?>/pages/staff/peminjaman/action/update.php" method="post">
            <input type="hidden" name="id" value="<?= $old['id'] ?>">
            <!-- Nama Member -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="nama">Nama Member</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <select name="id_member" id="id_member" class="px-2 py-3 w-full outline-none">
                        <option value="">--Pilih Member--</option>
                        <?php foreach ($member as $item): ?>
                            <option value="<?= $item['id'] ?>" <?= $old['id_member'] == $item['id'] ? 'selected'  : "" ?>><?= ucwords($item['username']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <!-- Nama Buku -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="nama">Nama Buku</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <select name="id_buku" id="id_buku" class="px-2 py-3 w-full outline-none">
                        <option value="">--Pilih Buku--</option>
                        <?php foreach ($buku as $item): ?>
                            <option value="<?= $item['id'] ?>" <?= $old['id_buku'] == $item['id'] ? 'selected' : '' ?>><?= ucwords($item['nama_buku']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="tanggal_pinjam">Tanggal pinjam</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input type="date"
                        name="tanggal_pinjam"
                        id="tanggal_pinjam"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $old['tanggal_pinjam'] ?>">
                </div>
            </div>
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="tenggat_waktu">Tenggat Waktu</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input type="date"
                        name="tenggat_waktu"
                        id="tenggat_waktu"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $old['tenggat_waktu'] ?>">
                </div>
            </div>
            <div class="my-10">
                <button type="submit" class="bg-blue-500 px-5 py-2 cursor-pointer shadow-lg text-white hover:bg-blue-900 hover:shadow-xl rounded-lg">Update</button>
            </div>
        </form>
    </div>
</section>