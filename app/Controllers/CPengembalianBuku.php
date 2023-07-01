<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MBuku;
use App\Models\MMurid;
use App\Models\MPeminjamanBuku;
use App\Models\MPengembalianBuku;
use App\Models\MAdmin;

class CPengembalianBuku extends BaseController
{
    protected $modelBuku;
    protected $modelMurid;
    protected $modelPeminjamanBuku;
    protected $modelAdmin;
    protected $modelPengembalianBuku;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper('auth'); // Menggunakan helper yang telah dibuat
        checkLoggedIn($this->session);

        $this->modelBuku = new MBuku();
        $this->modelMurid = new MMurid();
        $this->modelPeminjamanBuku = new MPeminjamanBuku();
        $this->modelAdmin = new MAdmin();
        $this->modelPengembalianBuku = new MPengembalianBuku();
    }

    public function index()
    {
        $data = [
            'title_web' => 'Data Peminjaman Buku | E-Library',
            'judul' => 'Data Peminjaman Buku',
            'user' => $this->session->get('user'),
            'buku' => $this->modelBuku->findAll(),
            'daftar_murid' => $this->modelMurid->findAll(),
            'peminjaman_buku' => $this->modelPeminjamanBuku->findAll(),
            'member' => $this->modelAdmin->findAll(),
            'pengembalian_buku' => $this->modelPengembalianBuku->findAll(),
        ];

        $pengembalian_buku = $this->modelPengembalianBuku->findAll();


        foreach ($pengembalian_buku as $index => $pengembalian) {
            $detail_peminjam = $this->getDetailPengembalian($pengembalian['nama_pengembali']);
            $pengembalian_buku[$index]['detail_pengembalian'] = $detail_peminjam;

            $detail_buku = $this->getDetailBuku($pengembalian['nama_buku_dikembalikan']);
            $pengembalian_buku[$index]['detail_buku'] = $detail_buku;
        }

        $data['pengembalian_buku'] = $pengembalian_buku;

        echo view('templates/header', $data);
        echo view('templates/navbar', $data);
        echo view('templates/sidebar');
        echo view('admin/data/view_pengembalian_buku', $data);
        echo view('templates/footer');
    }

    private function getDetailPengembalian($namaPengembali)
    {
        return $this->modelMurid->where('nama', $namaPengembali)->first();
    }

    private function getDetailBuku($judulBuku)
    {
        return $this->modelBuku->where('judul_buku', $judulBuku)->first();
    }

    public function returnPengembalianBeberapaBuku($id)
    {
        $pengembalianbeberapabuku = $this->request->getPost('inputpengembalianbeberapabuku');
        $jumlahbukudipinjamkan = $this->request->getPost('jumlahbukudipinjamkan');
        $jumlahbukudikembalikan = $this->request->getPost('jumlahbukudikembalikan');
        $tersisa = $jumlahbukudipinjamkan - $pengembalianbeberapabuku;

        if ($pengembalianbeberapabuku < 0) {
            return redirect()->to('/elibrary/admin/data-pengembalian-buku')->with('error', 'Jumlah buku yang dikembalikan tidak boleh kurang dari 0');
        }

        if ($pengembalianbeberapabuku == 0) {
            return redirect()->to('/elibrary/admin/data-pengembalian-buku')->with('error', 'Jumlah buku yang dikembalikan tidak boleh 0');
        }

        if ($pengembalianbeberapabuku > $jumlahbukudipinjamkan) {
            return redirect()->to('/elibrary/admin/data-pengembalian-buku')->with('error', 'Jumlah buku yang dikembalikan tidak boleh lebih dari jumlah buku yang dipinjamkan [1]');
        }

        if ($pengembalianbeberapabuku > $jumlahbukudikembalikan) {
            return redirect()->to('/elibrary/admin/data-pengembalian-buku')->with('error', 'Jumlah buku yang dikembalikan tidak boleh lebih dari jumlah buku yang dikembalikan');
        }

        if ($pengembalianbeberapabuku > $tersisa)
        {
            return redirect()->to('/elibrary/admin/data-pengembalian-buku')->with('error', 'Jumlah buku yang dikembalikan tidak boleh lebih dari jumlah buku yang dipinjamkan [2]');
        }

        $jumlahbukudikembalikan = $jumlahbukudikembalikan + $pengembalianbeberapabuku;

        if ($jumlahbukudikembalikan != $jumlahbukudipinjamkan)
        {
            $statusBuku = 'Belum Lunas';
        } else
        {
            $statusBuku = 'Lunas';
        }

        $data = [
            'jumlah_buku_dikembalikan' => $jumlahbukudikembalikan,
            'status_buku' => $statusBuku,
        ];

        $this->modelPengembalianBuku->update($id, $data);

        return redirect()->to('/elibrary/admin/data-pengembalian-buku')->with('success', 'Berhasil mengembalikan buku');
    }
}