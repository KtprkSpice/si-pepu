<?php
require_once __DIR__ . "/../../../config/config.php";
require_once __DIR__ . "/../../../auth/middleware/authMiddleware.php";
authMiddleware::check(['staff']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Tailwindcss -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/js/all.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.8/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title><?= strtoupper(APP_NAME) ?></title>
</head>

<body>
    <aside class="w-64 min-h-screen bg-gray-600 fixed flex flex-col">
        <div class="relative overflow-hidden flex items-center flex-col justify-center p-10">
            <div class="absolute inset-0 bg-center bg-cover blur-xs scale-110"
                style="background-image: url(https://images.unsplash.com/photo-1568667256549-094345857637?q=80&w=715&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
            </div>
            <div class="relative z-10 inset-0 flex flex-col items-center">
                <img src="https://i.pravatar.cc/150?img=3<?= $_SESSION['user_id'] ?>" alt="" class="rounded-full mb-5">
                <h2 class="text-white"><?= ucwords($_SESSION['username']) ?></h2>
            </div>
        </div>
        <div>
            <ul>
                <li>
                    <a href="#" class="p-5 border-b border-black block text-white flex gap-2 items-center">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/pages/staff/peminjaman/view/index.php" class="p-5 border-b border-black block text-white flex gap-2 items-center">
                        <i class="fa-solid fa-book"></i>
                        <span>Data Buku</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/pages/admin/kategori/view/index.php" class="p-5 border-b border-black block text-white flex gap-2 items-center">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Data Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/pages/admin/user/view/index.php" class="p-5 border-b border-black block text-white flex gap-2 items-center">
                        <i class="fa-solid fa-users"></i>
                        <span>Data Users</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mt-auto">
            <a href="<?= BASE_URL ?>/auth/login/logout.php" class="block p-5 text-white border-t border-black">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
</body>
<!-- Alert -->
<?php include(__DIR__ . "/../../../components/alert.php")  ?>

</html>