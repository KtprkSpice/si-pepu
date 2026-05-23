<?php

require_once __DIR__ . "/../model/kategori.php";

class KategoriController
{
    private $kategori;

    public function __construct($conn)
    {
        $this->kategori = new kategori($conn);
    }

    public function index()
    {
        return $this->kategori->index();
    }

    public function store($request)
    {
        try {
            $nama = $request['nama'];
            $kdKategori = $request['kd_kategori'];
            $deskripsi = $request['deskripsi'];

            if ($this->kategori->checkNama($nama)) {
                $_SESSION['error'] = 'Kategori sudah ada';
                header('Location: ../view/tambah.php');
                exit();
            }

            $this->kategori->insert([
                'nama' => $nama,
                'kd_kategori' => $kdKategori,
                'deskripsi' => $deskripsi
            ]);

            $_SESSION['success'] = 'Berhasil buat kategori baru';
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
            $nama = $request['nama'];
            $kdKategori = $request['kd_kategori'];
            $deskripsi = $request['deskripsi'];

            $this->kategori->edit([
                'id' => $id,
                'nama' => $nama,
                'kd_kategori' => $kdKategori,
                'deskripsi' => $deskripsi
            ]);

            $_SESSION['success'] = 'Berhasil buat kategori baru';
            header('Location: ../view/index.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../view/edit.php?id=$id");
            exit();
        }
    }

    public function delete($id)
    {
        try {
            if (!$this->kategori->checkKategori($id)) {
                $_SESSION['error'] = "data tidak ada";
                header('Location: ../view/index.php');
                exit();
            } else {
                $this->kategori->delete($id);
                $_SESSION['success'] = "data Berhasil dihapus";
                header('Location: ../view/index.php');
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: ../view/index.php");
            exit();
        }
    }
}
