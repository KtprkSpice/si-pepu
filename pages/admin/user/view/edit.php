<?php
require_once __DIR__ . "/../../layout/admin.php";

$id = $_GET['id'];

$q = $conn->prepare("
    SELECT * FROM users
    WHERE id = :id
");

$q->execute([
    'id' => $id,
]);

$user = $q->fetch(PDO::FETCH_ASSOC);
?>

<section class="ml-64 flex justify-center min-h-screen bg-gray-100 border border-black">
    <div class="border border-black w-full max-w-6xl p-10">
        <h2 class="text-2xl font-bold mb-10">Edit Data Pengguna <?= $user['username'] ?></h2>
        <!-- Form -->
        <form action="<?= BASE_URL ?>/pages/admin/user/action/update.php" method="post">
            <!-- Hidden Id-->
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <!-- username -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="username">Username</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        required
                        type="text"
                        name="username"
                        id="username"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $user['username'] ?>">
                </div>
            </div>
            <!--email-->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="email">Email</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        required
                        type="email"
                        name="email"
                        id="email"
                        class="px-2 py-3 w-full outline-none"
                        value="<?= $user['email'] ?>">
                </div>
            </div>
            <!-- Password -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="password">Password</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        required
                        type="password"
                        name="password"
                        id="password"
                        class="px-2 py-3 w-full outline-none">
                </div>
            </div>
            <!-- Password Confirmation -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="konfirmasi_password">Konfirmasi Password</label>
                <div class="border border-black flex items-stretch rounded-lg overflow-hidden">
                    <input
                        required
                        type="password"
                        name="konfirmasi_password"
                        id="konfirmasi_password"
                        class="px-2 py-3 w-full outline-none">
                </div>
            </div>
            <!-- role -->
            <div class="flex flex-col gap-2 max-w-lg p-5">
                <label for="role">Role</label>
                <select class="border border-black flex items-stretch rounded-lg overflow-hidden py-3" name="role">
                    <option value="member" <?= $user['role'] === 'member' ? 'selected' : '' ?>>Member</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : '' ?>>Staff</option>
                </select>
            </div>
            <div class="my-10">
                <button type="submit" class="bg-blue-500 px-5 py-2 cursor-pointer shadow-lg text-white hover:bg-blue-900 hover:shadow-xl rounded-lg">Update</button>
            </div>
        </form>
    </div>
</section>