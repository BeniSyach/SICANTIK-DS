<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $table      = 'tb_bidang';
    protected $allowedFields = ['id_bidang', 'nama_bidang'];
    protected $useTimestamps = false;
}
