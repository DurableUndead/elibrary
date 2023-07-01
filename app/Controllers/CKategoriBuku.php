<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MKategoriBuku;

use App\Libraries\CheckLoggedIn;
use Config\Services;

class CKategoriBuku extends BaseController
{
    protected $modelKategoriBuku;

    //protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper('auth');
        checkLoggedIn($this->session);

        $this->modelKategoriBuku = new MKategoriBuku();
    }

    public function index()
    {
        $data = [
            'title_web' => 'Daftar Kategori Buku | E-Library',
            'judul' => 'Daftar Kategori Buku',
            'user' => $this->session->get('user'),
            'kategori_buku' => $this->modelKategoriBuku->findAll(),
        ];

        echo view('templates/header', $data);
        echo view('templates/navbar', $data);
        echo view('templates/sidebar');
        echo view('admin/daftar/view_kategori_buku', $data);
        echo view('templates/footer');
    }

    public function createKategori()
    {
        $kategori_baru = $this->request->getPost('kategori_baru');

        //kategori sudah ada
        if ($this->modelKategoriBuku->where('nama_kategori', $kategori_baru)->first()) {
            return redirect()->to('/elibrary/admin/daftar-kategori-buku')->with('error', 'Kategori sudah ada.');
        }

        if (is_numeric($kategori_baru)) {
            return redirect()->to('/elibrary/admin/daftar-kategori-buku')->with('error', 'Kategori tidak boleh berupa angka.');
        }

        $data = [
            'nama_kategori' => $kategori_baru,
        ];

        $this->modelKategoriBuku->insert($data);

        return redirect()->to('/elibrary/admin/daftar-kategori-buku')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function updateKategori($id)
    {
        $kategori_baru = $this->request->getPost('edit-kategori');

        if (is_numeric($kategori_baru)) {
            return redirect()->to('/elibrary/admin/daftar-kategori-buku')->with('error', 'Kategori tidak boleh berupa angka.');
        }

        $data = [
            'nama_kategori' => $kategori_baru,
        ];

        $this->modelKategoriBuku->update($id, $data);

        return redirect()->to('/elibrary/admin/daftar-kategori-buku')->with('success', 'Kategori berhasil diubah.');
    }

    public function deleteKategori($id)
    {
        $kategori = $this->modelKategoriBuku->find($id)['nama_kategori'];
        $this->modelKategoriBuku->delete($id);

        return redirect()->to('/elibrary/admin/daftar-kategori-buku')->with('success', 'Kategori ( '. $kategori .' ) berhasil dihapus.');
    }
}
