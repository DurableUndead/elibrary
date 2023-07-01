<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MLogin;
use App\Models\MMember;
use App\Models\MBuku;
use App\Models\MKategoriBuku;

use App\Libraries\CheckLoggedIn;
use Config\Services;

class CClient extends BaseController
{
    public function index()
    {
        $modelBuku = new MBuku();
        $modelKategoriBuku = new MKategoriBuku();

        $data['judul'] = 'Daftar Buku';
        //$data['user'] = $this->session->get('user');
        $data['user'] = $this->session->get('user');
        $data['buku'] = $modelBuku->findAll();
        $data['kategori_buku'] = $modelKategoriBuku->findAll();
        //$data['$maxColumn'] = 4; // Atur nilai awal sesuai dengan jumlah kolom default

        echo view('view_students/index', $data);
    }
}