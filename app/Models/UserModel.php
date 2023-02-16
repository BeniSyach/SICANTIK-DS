<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $allowedFields = ['username', 'password', 'bidang_id', 'created_at'];
    protected $useTimestamps = false;
    protected $primaryKey = 'id_users';
}
