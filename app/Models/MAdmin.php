<?php

namespace App\Models;

use CodeIgniter\Model;

class MAdmin extends Model
{
    protected $table = 'admin';
    protected $allowedFields = ['nama', 'email', 'password', 'pin'];

    public function countMember()
    {
        return $this->countAll();
    }
}