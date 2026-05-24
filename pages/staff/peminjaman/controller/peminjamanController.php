<?php
require_once __DIR__ . "/../model/peminjaman.php";
class peminjamanController
{
    private $peminjaman;
    // Tambahin jika mau pake model relasi jagnan lupa import modelnya begitu juga di __contruct tambahin jadi public function __construct($peminjamanModel, $bukuModel)
    // private $buku

    public function __construct($peminjamanModel)
    {
        $this->peminjaman = $peminjamanModel;
        // Buat juga ini jika ada relasi
        // $this->buku = $bukuModel;
    }

    public function create($request)
    {
        try {
            $idMember = $request['id_member'];
            $idBuku = $request['id_buku'];
            $tanggalPinjam = $request['tanggal_pinjam'];
            $tenggatWaktu = $request['tenggat_waktu'];

            $this->peminjaman->insert([
                'id_member' => $idMember,
                'id_buku' => $idBuku,
                'tanggal_pinjam' => $tanggalPinjam,
                'tenggat_waktu' => $tenggatWaktu,
                'status' => 'peminjaman',
                'total_denda' => 0
            ]);

            $this->peminjaman->kurangiStock($idBuku);

            $_SESSION['success'] = 'Berhasil membuat peminjaman';
            header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/tambah.php');
            exit();
        }
    }

    public function update($request)
    {
        try {
            $id = $request['id'];
            $idMember = $request['id_member'];
            $idBuku = $request['id_buku'];
            $tanggalPinjam = $request['tanggal_pinjam'];
            $tenggatWaktu = $request['tenggat_waktu'];

            // ambil data pinjaman lama
            $oldData = $this->peminjaman->getById($id);

            // buku lama
            $oldBuku = $oldData['id_buku'];

            // kalau buku diganti
            if ($oldBuku != $idBuku) {

                // balikin stock buku lama
                $this->peminjaman->updateBuku($oldBuku);

                // kurangi stock buku baru
                $this->peminjaman->kurangiStock($idBuku);
            }

            $this->peminjaman->edit([
                'id' => $id,
                'id_member' => $idMember,
                'id_buku' => $idBuku,
                'tanggal_pinjam' => $tanggalPinjam,
                'tenggat_waktu' => $tenggatWaktu
            ]);

            $_SESSION['success'] = 'Berhasil update peminjaman';

            header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . BASE_URL . "/pages/staff/peminjaman/view/edit.pgp?id=$id");
            exit();
        }
    }

    public function delete($id)
    {
        try {
            $data = $this->peminjaman->getById($id);
            $this->peminjaman->updateBuku($data['id_buku']);
            $this->peminjaman->delete($id);
            $_SESSION['success'] = 'Berhasil menghapus peminjaman';
            header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Gagal menghapus';
            header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
            exit();
        }
    }

    public function pengembalian($id)
    {
        try {
            // Ambil data peminjaman
            $data = $this->peminjaman->getById($id);

            if (!$data) {
                $_SESSION['error'] = 'Data tidak ada';
                header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
                exit();
            }

            $today = new DateTime();
            $tenggat = new DateTime($data['tenggat_waktu']);

            $denda = 0;

            if ($data['status'] == 'dikembalikan') {
                $_SESSION['error'] = 'Buku sudah dikembalikan';
                header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
                exit();
            }

            if ($today > $tenggat) {
                // Selisih dari hari ini dengan tenggat
                $selisih = $today->diff($tenggat);

                // Ambil hari selisihnya misalakn tenggat waktu tanggal 20 lewat 3 hari berarti diambil 3 harinya
                $hariTelat  = $selisih->days;

                $dendaHarian = 5000;

                $denda = $hariTelat * $dendaHarian;
            }

            $this->peminjaman->updatePengembalian([
                'id' => $id,
                'status' => 'dikembalikan',
                'total_denda' => $denda
            ]);

            // Kenapa data id_buku karena cari berdasarkan id buku relasi
            $this->peminjaman->updateBuku($data['id_buku']);

            $_SESSION['success'] = 'Berhasil melakukan pengembalian';
            header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location:' . BASE_URL . '/pages/staff/peminjaman/view/index.php');
            exit();
        }
    }
}
