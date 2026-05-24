<?php
require_once __DIR__ . "/../model/peminjaman.php";

$data = new peminjamanModel($conn);

$pinjaman = $data->dataPinjaman();
