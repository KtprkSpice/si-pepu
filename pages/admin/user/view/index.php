<?php
require_once __DIR__ . "/../../layout/admin.php";
require_once __DIR__ . '/../action/show.php';
?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="w-full max-w-6xl p-10">
        <h1 class="text-2xl font-bold mb-10">Data Pengguna</h1>
        <div class="mb-10">
            <a href="<?= BASE_URL ?>/pages/admin/user/view/tambah.php" class="px-5 py-2 bg-blue-500 text-white rounded-lg">Tambah Pengguna</a>
        </div>
        <table id="listKategori" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($users as $user):
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= ucwords($user['username']) ?></td>
                        <td><?= ucwords($user['email']) ?></td>
                        <td><?= ucwords($user['role']) ?></td>
                        <td>
                            <div class="flex items-center gap-2 justify-center">
                                <a href="<?= BASE_URL ?>/pages/admin/user/view/edit.php?id=<?= $user['id'] ?>" class="p-1 w-8 bg-yellow-500 text-white rounded-lg">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= BASE_URL ?>/pages/admin/user/action/delete.php?id=<?= $user['id'] ?>" class="p-1 w-8 bg-red-500 text-white rounded-lg">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    let table = new DataTable('#listKategori');
</script>