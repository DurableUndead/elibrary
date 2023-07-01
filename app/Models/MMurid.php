<?php

namespace App\Models;

use CodeIgniter\Model;

class MMurid extends Model
{
    protected $table = 'daftar_murid';
    protected $allowedFields = [
        'nisn',
        'nama',
        'kelas',
        'kelompok_kelas',
        'jenis_kelamin',
        'tanggal_lahir',
        'wali_kelas'
    ];

    public function countMurid()
    {
        return $this->countAll();
    }
}
