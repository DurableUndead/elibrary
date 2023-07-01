<?php

namespace App\Models;

use CodeIgniter\Model;

class MBuku extends Model
{
    protected $table = 'buku';
    protected $allowedFields = [
        'judul_buku', 
        'pengarang', 
        'penerbit', 
        'tahun_terbit', 
        'kategori', 
        'jumlah_buku', 
        'gambar_buku'
    ];

    public function countBooks()
    {
        return $this->countAll();
    }
}