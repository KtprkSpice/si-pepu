<?php
require_once __DIR__ . "/../../config/config.php";

$code = $_GET['code'] ?? 404;

$errorMessages = [
    401 => 'Unauthorized',
    403 => 'Forbidden Access',
    404 => 'Page Not Found',
    500 => 'Internal Server Error'
];

$message = $errorMessages[$code] ?? 'unknown error';

http_response_code($code);

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


    <main class="h-screen w-full flex flex-col justify-center items-center bg-[#1A2238]">
        <h1 class="text-9xl font-extrabold text-white tracking-widest">
            <?= $code ?>
        </h1>
        <div class="bg-[#FF6A3D] px-2 text-sm rounded rotate-12 absolute">
            <?= $message ?>
        </div>
        <button class="mt-5">
            <a
                class="relative inline-block text-sm font-medium text-[#FF6A3D] group active:text-orange-500 focus:outline-none focus:ring">
                <span
                    class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-[#FF6A3D] group-hover:translate-y-0 group-hover:translate-x-0"></span>

                <span class="relative block px-8 py-3 bg-[#1A2238] border border-current">
                    <router-link to="/">Go Home</router-link>
                </span>
            </a>
        </button>
    </main>
</body>

</html>