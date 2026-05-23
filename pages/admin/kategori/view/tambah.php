<?php
require_once __DIR__ . "/../../layout/admin.php";

?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="border border-black w-full max-w-6xl p-10">
        <h2 class="text-2xl font-bold mb-10">Tambah Kategori</h2>
        <form action="<?= BASE_URL ?>/pages/admin/kategori/action/simpan.php" method="post">
            <!-- Nama Kategori -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="nama">Nama Kategori</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        required
                        type="text"
                        name="nama"
                        id="nama"
                        class="px-2 py-3 w-full outline-none">
                </div>
            </div>
            <!-- Kode Kategori -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="kd_kategori">Kode Kategori</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        required
                        type="text"
                        name="kd_kategori"
                        id="kd_kategori"
                        class="px-2 py-3 w-full outline-none">
                </div>
            </div>
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="deskripsi">Deskripsi</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <textarea name="deskripsi" id="deskripsi" class="px-2 py-3 w-full outline-none"></textarea>
                </div>
            </div>
            <div class="my-10">
                <button type="submit" class="bg-blue-500 px-5 py-2 cursor-pointer shadow-lg text-white hover:bg-blue-900 hover:shadow-xl rounded-lg">Tambah</button>
            </div>
        </form>
    </div>
</section>