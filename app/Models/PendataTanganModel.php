<?php

namespace App\Models;

use CodeIgniter\Model;

class PendataTanganModel extends Model
{
    protected $table      = 'tb_pendata_tangan';
    protected $allowedFields = ['nama_tanda_tangan', 'nip', 'jabatan', 'golongan', 'gambar'];
    protected $useTimestamps = false;

    public function id_terakhir()
    {
        return $this->db->table('tb_pendata_tangan')->orderBy('id_tanda_tangan', 'DESC')->get()->getRowArray();
    }
}
