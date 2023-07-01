<?php

namespace App\Models;

use CodeIgniter\Model;

class MPengembalianBuku extends Model
{
    protected $table = 'pengembalian_buku';
    protected $allowedFields = [
        'nama_admin_penerima_buku',
        'nama_pengembali',
        'kelas_pengembali',
        'kelompok_kelas_pengembali',
        'nama_buku_dikembalikan',
        'jumlah_buku_dipinjamkan',
        'jumlah_buku_dikembalikan',
        'tanggal_peminjaman_buku',
        'tanggal_pengembalian_buku',
        'gambar_buku_dikembalikan',
        'status_buku',
    ];

    public function countPengembalian()
    {
        return $this->countAll();
    }
}
