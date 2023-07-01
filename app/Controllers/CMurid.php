<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MMurid;

use Config\Services;

class CMurid extends BaseController
{
    protected $modelMurid;

    public function __construct()
    {
        //print('dawdawdawdawdaw'); // Tambahkan pernyataan print di sini
        $this->session = \Config\Services::session();
        helper('auth'); // Menggunakan helper yang telah dibuat
        checkLoggedIn($this->session);
    
        $this->modelMurid = new MMurid();
    }

    public function index()
    {
        $data = [
            'title_web' => 'E-Library | Daftar Murid',
            'judul' => 'Daftar Murid',
            'user' => $this->session->get('user'),
            'daftar_murid' => $this->modelMurid->findAll()
        ];

        echo view('templates/header', $data);
        echo view('templates/navbar', $data);
        echo view('templates/sidebar');
        echo view('admin/daftar/view_daftar_murid', $data);
        echo view('templates/footer');
    }

    public function createMurid()
    {
        $nisn = $this->request->getPost('nisnTambah');
        $nama = $this->request->getPost('namaTambah');
        $kelas = $this->request->getPost('kelasTambah');
        $kelompok_kelas = $this->request->getPost('kelompok_kelasTambah');
        $jenis_kelamin = $this->request->getPost('jenis_kelaminTambah');
        $tanggal_lahir = $this->request->getPost('tanggal_lahirTambah');
        $wali_kelas = $this->request->getPost('wali_kelasTambah');

        if ($this->modelMurid->find($nisn)) {
            return redirect()->to('elibrary/admin/daftar-murid')->with('error', 'Murid (' . $nisn . ') sudah ada');
        }

        if (is_string($nisn) && strlen($nisn) != 10)
        {
            return redirect()->to('elibrary/admin/daftar-murid')->with('error', 'NISN harus 10 digit');
        }

        if (!is_numeric($nisn))
        {
            return redirect()->to('elibrary/admin/daftar-murid')->with('error', 'NISN harus berupa angka');
        }

        if ($tanggal_lahir > date('Y-m-d'))
        {
            return redirect()->to('elibrary/admin/daftar-murid')->with('error', 'Tanggal lahir tidak valid');
        }        

        $data = [
            'nisn' => $nisn,
            'nama' => $nama,
            'kelas' => $kelas,
            'kelompok_kelas' => $kelompok_kelas,
            'jenis_kelamin' => $jenis_kelamin,
            'tanggal_lahir' => $tanggal_lahir,
            'wali_kelas' => $wali_kelas
        ];

        $this->modelMurid->insert($data);

        return redirect()->to('elibrary/admin/daftar-murid')->with('success', 'Murid (' . $nama . ' dari kelas ' .$kelas .') berhasil ditambahkan');
    }

    public function deleteMurid($id)
    {
        $murid = $this->modelMurid->find($id);
        $nama = $murid['nama'];
        $kelas = $murid['kelas'];
        $this->modelMurid->delete($id);

        return redirect()->to('elibrary/admin/daftar-murid')->with('success', 'Murid (' . $nama . ' dari kelas ' .$kelas .') berhasil dihapus');
    }

    public function updateMurid($id)
    {
        $nisn = $this->request->getPost('nisnEdit');
        $nama = $this->request->getPost('namaEdit');
        $kelas = $this->request->getPost('kelasEdit');
        $kelompok_kelas = $this->request->getPost('kelompok_kelasEdit');
        $jenis_kelamin = $this->request->getPost('jenis_kelaminEdit');
        $tanggal_lahir = $this->request->getPost('tanggal_lahirEdit');
        $wali_kelas = $this->request->getPost('wali_kelasEdit');

        if (is_string($nisn) && strlen($nisn) != 10)
        {
            return redirect()->to('elibrary/admin/daftar-murid')->with('error', 'NISN harus 10 digit');
        }

        if (!is_numeric($nisn))
        {
            return redirect()->to('elibrary/admin/daftar-murid')->with('error', 'NISN harus berupa angka');
        }

        if ($tanggal_lahir > date('Y-m-d'))
        {
            return redirect()->to('elibrary/admin/daftar-murid')->with('error', 'Tanggal lahir tidak valid');
        }

        $data = [
            'nisn' => $nisn,
            'nama' => $nama,
            'kelas' => $kelas,
            'kelompok_kelas' => $kelompok_kelas,
            'jenis_kelamin' => $jenis_kelamin,
            'tanggal_lahir' => $tanggal_lahir,
            'wali_kelas' => $wali_kelas
        ];

        $this->modelMurid->update($id, $data);

        return redirect()->to('elibrary/admin/daftar-murid')->with('success', 'Murid (' . $nama . ' dari kelas '. $kelas . ') berhasil diubah');
    }
}