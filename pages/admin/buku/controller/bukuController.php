<?php
require_once __DIR__ . "/../model/buku.php";

class bukuController
{
    private $bukuModel;

    public function __construct($conn)
    {
        $this->bukuModel = new buku($conn);
    }

    public function store($request)
    {
        try {
            $idKategori = $request['id_kategori'];
            $namaBuku = $request['nama_buku'];
            $namaPenerbit = $request['nama_penerbit'];
            $namaPenulis = $request['nama_penulis'];
            $isbn = $request['isbn'];
            $tgl_rilis_buku = $request['tgl_rilis_buku'];

            $kategori = $this->bukuModel->getKategoriById($idKategori);

            if (!$kategori) {
                $_SESSION['error'] = 'Kategori tidak ada';
                header('Location ../view/tambah.php');
                exit();
            }

            $kdKategori = strtoupper($kategori['kd_kategori']);

            // Ambil kode buku dari yang di request misalkan kategori Novel dipilah ambil code buku untuk Novel = NV
            $lastBookCode = $this->bukuModel->getLastCodeBuku($kdKategori);

            if ($lastBookCode) {
                $lastNumber = (int) substr($lastBookCode['code_buku'], 2);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $codeBuku = $kdKategori . str_pad($newNumber, 3, "0", STR_PAD_LEFT);

            $this->bukuModel->insert([
                'code_buku' => $codeBuku,
                'nama_buku' => $namaBuku,
                'id_kategori' => $idKategori,
                'nama_penerbit' => $namaPenerbit,
                'isbn' => $isbn,
                'nama_penulis' => $namaPenulis,
                'tgl_rilis_buku' => $tgl_rilis_buku
            ]);

            $_SESSION['success'] =  'Berhasil Menambah Buku';
            header('Location: ../view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ../view/tambah.php');
            exit();
        }
    }

    public function update($request)
    {
        try {
            $id = $request['id'];
            $idKategori = $request['id_kategori'];

            $namaBuku = $request['nama_buku'];
            $namaPenerbit = $request['nama_penerbit'];
            $namaPenulis = $request['nama_penulis'];
            $isbn = $request['isbn'];
            $tgl_rilis_buku = $request['tgl_rilis_buku'];
            $tgl_masuk = $request['tgl_masuk'];

            $kategori = $this->bukuModel->getKategoriById($idKategori);

            if (!$kategori) {
                $_SESSION['error'] = 'Kategori tidak ada';
                header('Location: ../view/tambah.php');
                exit();
            }

            $kdKategori = strtoupper($kategori['kd_kategori']);

            // cari code terakhir berdasarkan kategori
            $lastCode = $this->bukuModel->getLastCodeBuku($kdKategori);

            if ($lastCode) {
                $lastNumber = (int) substr($lastCode['code_buku'], 2);
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $kodeBuku = $kdKategori . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

            $this->bukuModel->edit([
                'id' => $id,
                'id_kategori' => $idKategori,
                'code_buku' => $kodeBuku,
                'nama_buku' => $namaBuku,
                'nama_penerbit' => $namaPenerbit,
                'nama_penulis' => $namaPenulis,
                'tgl_rilis_buku' => $tgl_rilis_buku,
                'isbn' => $isbn,
                'tgl_masuk' => $tgl_masuk
            ]);

            $_SESSION['success'] = 'Berhasil update data';
            header('Location: ../view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ../view/tambah.php');
            exit();
        }
    }

    public function delete($id)
    {
        try {
            if (!$this->bukuModel->checKBuku($id)) {
                $_SESSION['error'] = 'Buku tidak ada';
                header('Location: ../view/index.php');
                exit();
            } else {
                $this->bukuModel->delete($id);
                $_SESSION['success'] = 'Berhasil hapus data';
                header('Location: ../view/index.php');
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ../view/index.php');
            exit();
        }
    }

    public function view()
    {
        return $this->bukuModel->index();
    }
}
