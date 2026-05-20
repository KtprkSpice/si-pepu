<?php
require_once __DIR__ . "/../../layout/admin.php";

?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="border border-black w-full max-w-6xl p-10">
        <h2 class="text-2xl font-bold mb-10">Tambah Buku</h2>
        <form action="">
            <div class="flex flex-col gap-5 max-w-lg p-5">
                <label for="id_kategori">Kategori buku</label>
                <select name="id_kategori" id="id_kategori" class="border border-gray-500 rounded-xl p-2 outeline-none">
                    <option value="">--Pilih Kategori--</option>
                    <option value="">Kategori 1</option>
                </select>
            </div>
        </form>
    </div>
</section>