<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MBuku;
use App\Models\MMurid;
use App\Models\MPeminjamanBuku;
use App\Models\MAdmin;
use App\Models\MPengembalianBuku;

class CPeminjamanBuku extends BaseController
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
        // Mengambil data peminjaman buku
        $peminjaman_buku = $this->modelPeminjamanBuku->findAll();

        // Mengambil detail peminjam untuk setiap peminjaman buku
        foreach ($peminjaman_buku as $index => $peminjaman) {
            $detail_peminjam = $this->getDetailPeminjam($peminjaman['nama_peminjam']);
            $peminjaman_buku[$index]['detail_peminjam'] = $detail_peminjam;

            // Mengambil detail buku untuk setiap peminjaman buku
            $detail_buku = $this->getDetailBuku($peminjaman['buku_dipinjam']);
            $peminjaman_buku[$index]['detail_buku'] = $detail_buku;
        }

        $data = [
            'title_web' => 'Daftar Peminjaman Buku | E-Library',
            'judul' => 'Data Peminjaman Buku',
            'user' => $this->session->get('user'),
            'buku' => $this->modelBuku->findAll(),
            'daftar_murid' => $this->modelMurid->findAll(),
            'peminjaman_buku' => $this->modelPeminjamanBuku->findAll(),
            'admin' => $this->modelAdmin->findAll(),
            'peminjaman_buku' => $peminjaman_buku,
            
        ];

        echo view('templates/header', $data);
        echo view('templates/navbar', $data);
        echo view('templates/sidebar');
        echo view('admin/data/view_peminjaman_buku', $data);
        echo view('templates/footer');
    }

    private function getDetailPeminjam($namaPeminjam)
    {
        // Mengambil detail murid dari model murid berdasarkan nama peminjam
        return $this->modelMurid->where('nama', $namaPeminjam)->first();
    }

    private function getDetailBuku($judulBuku)
    {
        // Mengambil detail buku dari model buku berdasarkan judul buku
        return $this->modelBuku->where('judul_buku', $judulBuku)->first();
    }

    public function createPeminjamanBuku()
    {
        $nama_Admin = $this->request->getPost('namaAdminTambahPeminjaman');
        $nama_peminjam = $this->request->getPost('namaPeminjamTambahPeminjaman');
        $kelas_peminjam = $this->request->getPost('kelasTambahPeminjaman');
        $kelompok_kelas_peminjam = $this->request->getPost('kelompokKelasTambahPeminjaman');
        $buku_dipinjam = $this->request->getPost('judulBukuTambahPeminjaman');
        $jumlah_buku_dipinjam = $this->request->getPost('jumlahBukuDipinjamTambahPeminjaman');
        $tanggal_peminjaman = $this->request->getPost('tanggalPinjamTambahPeminjaman');

        if ($jumlah_buku_dipinjam < 0) {
            return redirect()->to('/admin/peminjamanbuku')->with('error', 'Jumlah buku yang dipinjam tidak boleh kurang dari 0');
        }

        $jumlahBukuTersisa = $this->modelBuku->where('judul_buku', $buku_dipinjam)->first()['jumlah_buku'];
        if ($jumlah_buku_dipinjam > $jumlahBukuTersisa) {
            return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('error', 'Jumlah buku yang dipinjam melebihi jumlah buku yang tersedia');
        }

        $data = [
            'nama_admin_peminjam_buku' => $nama_Admin,
            'nama_peminjam' => $nama_peminjam,
            'kelas_peminjam' => $kelas_peminjam,
            'kelompok_kelas_peminjam' => $kelompok_kelas_peminjam,
            'buku_dipinjam' => $buku_dipinjam,
            'jumlah_buku_dipinjam' => $jumlah_buku_dipinjam,
            'tanggal_peminjaman' => $tanggal_peminjaman,
        ];

        $this->modelPeminjamanBuku->insert($data);

        // Mengurangi jumlah buku yang tersedia
        $this->modelBuku->where('judul_buku', $buku_dipinjam)->set('jumlah_buku', $jumlahBukuTersisa - $jumlah_buku_dipinjam)->update();

        return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('success', 'Peminjaman buku berhasil ditambahkan');
    }

    public function deletePeminjamanBuku($id)
    {
        $idPeminjamanBuku = $this->modelPeminjamanBuku->find($id);
        $bukuDipinjam = $idPeminjamanBuku['buku_dipinjam'];
        $namaPeminjman = $idPeminjamanBuku['nama_peminjam'];
        $kelasPeminjman = $idPeminjamanBuku['kelas_peminjam'];
        $kelompok_kelas_peminjam = $idPeminjamanBuku['kelompok_kelas_peminjam'];

        // Mengembalikan jumlah buku yang tersedia
        $jumlahBukuTersisa = $this->modelBuku->where('judul_buku', $bukuDipinjam)->first()['jumlah_buku'];
        $jumlahBukuDipinjam = $idPeminjamanBuku['jumlah_buku_dipinjam'];
        $this->modelBuku->where('judul_buku', $bukuDipinjam)->set('jumlah_buku', $jumlahBukuTersisa + $jumlahBukuDipinjam)->update();

        $this->modelPeminjamanBuku->delete($id);

        //jika judul buku kepanjangann
        if (strlen($bukuDipinjam) > 20) {
            $bukuDipinjam = substr($bukuDipinjam, 0, 17) . '...';
        }

        return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('success', 'Peminjaman Buku : ' . $bukuDipinjam . ' dengan peminjam  ' . $namaPeminjman . ' dari kelas ' . $kelasPeminjman . 'dan kelompok kelas : ' . $kelompok_kelas_peminjam . ' berhasil dihapus');
    }

    public function updatePeminjamanBuku($id)
    {
        $nama_admin_peminjaman = $this->request->getPost('namaAdminEditPeminjaman');
        $nama_peminjam = $this->request->getPost('namaPeminjamEditPeminjaman');
        $kelas_peminjam = $this->request->getPost('kelasEditPeminjaman');
        $kelompok_kelas_peminjam = $this->request->getPost('kelompokKelasEditPeminjaman');
        $buku_dipinjam = $this->request->getPost('judulBukuEditPeminjaman');
        $jumlah_bukut_bekas_dipinjam = $this->request->getPost('jumlahBukuBekasEditPeminjaman');
        $jumlah_buku_dipinjam = $this->request->getPost('jumlahBukuDipinjamEditPeminjaman');
        $tanggal_peminjaman = $this->request->getPost('tanggalPinjamEditPeminjaman');

        if ($jumlah_buku_dipinjam < 0) {
            return redirect()->to('/admin/peminjamanbuku')->with('error', 'Jumlah buku yang dipinjam tidak boleh kurang dari 0');
        }

        if ($jumlah_buku_dipinjam == 0)
        {
            return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('error', 'Jumlah buku yang dipinjam tidak boleh 0');
        }

        // $jumlahBukuTersisa = $this->modelBuku->where('judul_buku', $buku_dipinjam)->first()['jumlah_buku'];
        $result = $this->modelBuku->where('judul_buku', $buku_dipinjam)->first();

        if ($result !== null) {
            $jumlahBukuTersisa = $result['jumlah_buku'];
        } else {
            // Tangani kasus ketika tidak ada baris yang cocok
            return redirect()->to('/elibrary/admin/datapeminjamanbuku')->with('error', 'Buku yang dipinjam tidak ditemukan ('. $buku_dipinjam .')');
        }

        if ($jumlah_buku_dipinjam > $jumlahBukuTersisa) {
            return redirect()->to('/elibrary/admin/datapeminjamanbuku')->with('error', 'Jumlah buku yang dipinjam melebihi jumlah buku yang tersedia');
        }

        $jumlahBukuTersisa = $jumlahBukuTersisa + $jumlah_bukut_bekas_dipinjam;

        // Mengembalikan jumlah buku yang tersedia
        $this->modelBuku->where('judul_buku', $buku_dipinjam)->set('jumlah_buku', $jumlahBukuTersisa)->update();

        // penjumlahan 
        $jumlahBukuTersisa = $jumlahBukuTersisa - $jumlah_buku_dipinjam;

        // Mengurangi jumlah buku yang tersedia
        $this->modelBuku->where('judul_buku', $buku_dipinjam)->set('jumlah_buku', $jumlahBukuTersisa)->update();

        $data = [
            'nama_admin_peminjam_buku' => $nama_admin_peminjaman,
            'nama_peminjam' => $nama_peminjam,
            'kelas_peminjam' => $kelas_peminjam,
            'kelompok_kelas_peminjam' => $kelompok_kelas_peminjam,
            'buku_dipinjam' => $buku_dipinjam,
            'jumlah_buku_dipinjam' => $jumlah_buku_dipinjam,
            'tanggal_peminjaman' => $tanggal_peminjaman,
        ];

        $this->modelPeminjamanBuku->update($id, $data);

        return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('success', 'Peminjaman buku berhasil diubah');
    }

    public function moveToPengembalianBuku($id)
    {
        $nama_admin_peminjam_buku = $this->request->getPost('nama_admin_peminjam_buku');
        $nama_peminjam = $this->request->getPost('nama_peminjam');
        $kelas_peminjam = $this->request->getPost('kelas_peminjam');
        $kelompok_kelas_peminjam = $this->request->getPost('kelompok_kelas_peminjam');
        $buku_dipinjam = $this->request->getPost('buku_dipinjam');
        $jumlah_buku_dipinjam = $this->request->getPost('jumlah_buku_dipinjam');
        $tanggal_peminjaman = $this->request->getPost('tanggal_peminjaman');
        $tanggal_pengembalian = $this->request->getPost('tanggal_pengembalian');
        $jumlah_buku_dikembalikan = $this->request->getPost('jumlahBukuDikembalikan');

        if ($jumlah_buku_dikembalikan == 0)
        {
            return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('error', 'Jumlah buku yang dikembalikan tidak boleh 0');
        }

        if ($jumlah_buku_dikembalikan < 0)
        {
            return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('error', 'Jumlah buku yang dikembalikan tidak boleh kurang dari 0');
        }

        if ($jumlah_buku_dikembalikan > $jumlah_buku_dipinjam)
        {
            return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('error', 'Jumlah buku yang dikembalikan melebihi jumlah buku yang dipinjam');
        }

        if ($jumlah_buku_dikembalikan != $jumlah_buku_dipinjam)
        {
            $statusBuku = 'Belum Lunas';
        } else
        {
            $statusBuku = 'Lunas';
        }

        $data = [
            'nama_admin_penerima_buku' => $nama_admin_peminjam_buku,
            'nama_pengembali' => $nama_peminjam,
            'kelas_pengembali' => $kelas_peminjam,
            'kelompok_kelas_pengembali' => $kelompok_kelas_peminjam,
            'nama_buku_dikembalikan' => $buku_dipinjam,
            'jumlah_buku_dipinjamkan' => $jumlah_buku_dipinjam,
            'jumlah_buku_dikembalikan' => $jumlah_buku_dikembalikan,
            'tanggal_peminjaman_buku' => $tanggal_peminjaman,
            'tanggal_pengembalian_buku' => $tanggal_pengembalian,
            'status_buku' => $statusBuku,
        ];

        
        $this->modelPengembalianBuku->insert($data);
        $this->modelPeminjamanBuku->delete($id);

        return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('success', 'Peminjaman buku berhasil dipindahkan ke pengembalian buku');
    }

    public function pindahKeBukuHilang($id)
    {
        $data = [
            'id' => $id,
            'status' => 'kehilangan'
        ];

        // $this->modelPeminjamanBuku->update($id, $data);

        return redirect()->to('/elibrary/admin/data-peminjaman-buku')->with('success', 'Peminjaman buku berhasil dipindahkan ke kehilangan buku');
    }
}
