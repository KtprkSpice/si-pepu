<?php
require_once __DIR__ . "/../../layout/admin.php";

?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="border border-black w-full max-w-6xl p-10">
        <h2 class="text-2xl font-bold mb-10">Tambah Buku</h2>
        <form action="">
            <!-- Kategori buku -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="id_kategori">Kategori buku</label>
                <select name="id_kategori" id="id_kategori" class="border border-gray-500 rounded-xl px-2 py-3 outline-none">
                    <option value="">--Pilih Kategori--</option>
                    <option value="">Kategori 1</option>
                </select>
            </div>
            <!-- Nama Buku -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="nama_buku">Nama Buku</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <span class="border-r border-black px-3 flex items-center bg-gray-100">SF</span>
                    <input
                        type="text"
                        name="nama_buku"
                        id="nama_buku"
                        class="px-2 py-3 w-full outline-none">
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
                        class="px-2 py-3 w-full outline-none">
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
                        class="px-2 py-3 w-full outline-none">
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
                        class="px-2 py-3 w-full outline-none">
                </div>
            </div>
            <div class="my-10">
                <button type="submit" class="bg-blue-500 px-5 py-2 cursor-pointer shadow-lg text-white hover:bg-blue-900 hover:shadow-xl rounded-lg">Tambah</button>
            </div>
        </form>
    </div>
</section>