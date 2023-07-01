<?php

namespace App\Models;

use CodeIgniter\Model;

class MPeminjamanBuku extends Model
{
    protected $table = 'peminjaman_buku';
    protected $allowedFields = [
        'nama_admin_peminjam_buku',
        'nama_peminjam',
        'kelas_peminjam',
        'kelompok_kelas_peminjam',
        'buku_dipinjam',
        'jumlah_buku_dipinjam',
        'tanggal_peminjaman',
        'gambar_buku_dipinjam'
    ];

    public function countPeminjaman()
    {
        return $this->countAll();
    }
}
