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
}
