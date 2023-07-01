<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MAdmin;
use App\Models\MBuku;
use App\Models\MKategoriBuku;

use Config\Services;

class CBuku extends BaseController
{
    protected $modelAdmin;
    protected $modelBuku;
    protected $modelKategoriBuku;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper('auth'); // Menggunakan helper yang telah dibuat
        checkLoggedIn($this->session);

        $this->modelAdmin = new MAdmin();
        $this->modelBuku = new MBuku();
        $this->modelKategoriBuku = new MKategoriBuku();
    }

    public function index()
    {

        $data = [
            'title_web' => 'Daftar Buku | E-Library',
            'judul' => 'Daftar Buku',
            'user' => $this->session->get('user'),
            'buku' => $this->modelBuku->findAll(),
            'kategori_buku' => $this->modelKategoriBuku->findAll(),
        ];

        echo view('templates/header', $data);
        echo view('templates/navbar', $data);
        echo view('templates/sidebar');
        echo view('admin/daftar/view_daftar_buku', $data);
        echo view('templates/footer');
    }

    public function createBuku()
    {
        $judul_buku = $this->request->getPost('judul_buku');
        $pengarang = $this->request->getPost('pengarang');
        $penerbit = $this->request->getPost('penerbit');
        $tahun_terbit = $this->request->getPost('tahun_terbit');
        $kategori = $this->request->getPost('kategori_select');
        $jumlah_buku = $this->request->getPost('jumlah_buku');
        $gambar_buku = $this->request->getFile('gambar_buku');

        if ($gambar_buku && $gambar_buku->isValid()) {
            $newName = $judul_buku . $gambar_buku->getRandomName();
            $combineName = $judul_buku . $newName;
            $gambar_buku->move(ROOTPATH . 'public/images/book', $combineName); //memasukan gambar ke folder public/images/book
            $data['gambar_buku'] = $combineName;
        } else {
            $data['gambar_buku'] = 'default.jpg'; //jika gambar tidak dimasukan maka akan menggunakan gambar default.jpg
        }

        if (is_numeric($judul_buku)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Judul buku tidak boleh berupa angka.');
        }
        if (is_numeric($pengarang)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Pengarang tidak boleh berupa angka.');
        }
        if (is_numeric($penerbit)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Penerbit tidak boleh berupa angka.');
        }
        if (!is_numeric($jumlah_buku)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Jumlah buku harus berupa angka.');
        }
        if (!is_numeric($tahun_terbit)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Tahun terbit harus berupa angka.');
        }
        
        if ($this->modelBuku->where('judul_buku', $judul_buku)->first() != null && $this->modelBuku->where('pengarang', $pengarang)->first() != null && $this->modelBuku->where('penerbit', $penerbit)->first() != null) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Buku sudah ada dalam daftar buku.');
        }
        if ($jumlah_buku < 0) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Jumlah buku tidak boleh kurang dari 0.');
        }
        if ($tahun_terbit > date('Y')) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Tahun terbit tidak boleh lebih dari tahun sekarang.');
        }
        if (strlen($tahun_terbit) != 4) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Tahun terbit harus 4 digit angka.');
        }


        $data = [
            'judul_buku' => $judul_buku,
            'pengarang' => $pengarang,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'kategori' => $kategori,
            'jumlah_buku' => $jumlah_buku,
            'gambar_buku' => $data['gambar_buku'],
        ];

        $this->modelBuku->insert($data);

        return redirect()->to('/elibrary/admin/daftar-buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function updateBuku($id)
    {
        $judul_buku = $this->request->getPost('edit_judul_buku');
        $gambar_buku = $this->request->getFile('edit_gambar_buku');
        $gambar_lama_buku = $this->request->getPost('edit_gambar_lama');
        $pengarang = $this->request->getPost('edit_pengarang');
        $penerbit = $this->request->getPost('edit_penerbit');
        $tahun_terbit = $this->request->getPost('edit_tahun_terbit');
        $kategori = $this->request->getPost('edit_kategori');
        $jumlah_buku = $this->request->getPost('edit_jumlah_buku');

        // $dataBuku = $model->find($id); // Mengambil data buku dari database

        if (!empty($gambar_buku) && $gambar_buku->isValid()) {
            // Hapus gambar lama jika ada
            if ($gambar_lama_buku != null && file_exists(FCPATH . 'images/book/' . $gambar_lama_buku)) {
                unlink(FCPATH . 'images/book/' . $gambar_lama_buku);
            }

            $newName = $judul_buku . $gambar_buku->getRandomName();
            $combineName = $judul_buku . $newName;
            $gambar_buku->move(ROOTPATH . 'public/images/book', $combineName);
            $data['gambar_buku'] = $combineName;
        } else {
            $data['gambar_buku'] = $gambar_lama_buku;
        }

        if (is_numeric($judul_buku)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Judul buku tidak boleh berupa angka.');
        }
        if (is_numeric($pengarang)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Pengarang tidak boleh berupa angka.');
        }
        if (is_numeric($penerbit)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Penerbit tidak boleh berupa angka.');
        }
        if (!is_numeric($jumlah_buku)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Jumlah buku harus berupa angka.');
        }
        if (!is_numeric($tahun_terbit)) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Tahun terbit harus berupa angka.');
        }
        
        if ($jumlah_buku < 0) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Jumlah buku tidak boleh kurang dari 0.');
        }
        if ($tahun_terbit > date('Y')) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Tahun terbit tidak boleh lebih dari tahun sekarang.');
        }
        if (strlen($tahun_terbit) != 4) {
            return redirect()->to('/elibrary/admin/daftar-buku')->with('error', 'Tahun terbit harus 4 digit angka.');
        }

        $data = [
            'judul_buku' => $judul_buku,
            'pengarang' => $pengarang,
            'penerbit' => $penerbit,
            'tahun_terbit' => $tahun_terbit,
            'kategori' => $kategori,
            'jumlah_buku' => $jumlah_buku,
            'gambar_buku' => $data['gambar_buku'],
        ];

        $this->modelBuku->update($id, $data);

        return redirect()->to('/elibrary/admin/daftar-buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function deleteBuku($id)
    {
        $buku = $this->modelBuku->find($id)['judul_buku'];
        $this->modelBuku->delete($id);

        return redirect()->to('/elibrary/admin/daftar-buku')->with('success', 'Buku ( '. $buku  .' ) berhasil dihapus.');
    }
}
