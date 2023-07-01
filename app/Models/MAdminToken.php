<?php

namespace App\Models;

use CodeIgniter\Model;

class MAdminToken extends Model
{
    protected $table = 'admin_token';
    protected $allowedFields = ['admin_id', 'auth_key'];
}
