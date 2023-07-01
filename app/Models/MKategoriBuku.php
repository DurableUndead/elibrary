<?php

namespace App\Models;

use CodeIgniter\Model;

class MKategoriBuku extends Model
{
    protected $table = 'kategori_buku'; //nama tabel di database
    protected $allowedFields = ['nama_kategori'];

    public function countKategoriBuku()
    {
        return $this->countAll();
    }
}
