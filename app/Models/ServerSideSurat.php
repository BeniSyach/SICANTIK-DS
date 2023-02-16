<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class ServerSideSurat extends Model
{
    protected $table = "tb_surat";
    protected $column_order = array('tanggal_naskah', 'nomor_naskah', 'hal', 'unit_kerja_id', 'tujuan_utama_id', 'tingkat_urgensi_id', 'sifat_naskah_id', null);
    protected $column_search = array('nomor_naskah', 'hal', 'tanggal_naskah', 'tujuan_naskah');
    protected $order = array('tanggal_naskah' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt = $this->db->table($this->table)->join('tb_jenis_naskah', 'tb_jenis_naskah.id_jenis_naskah=tb_surat.jenis_naskah_id')
            ->join('tb_klasifikasi', 'tb_klasifikasi.id_klasifikasi=tb_surat.klasifikasi_id')
            ->join('tb_pendata_tangan', 'tb_pendata_tangan.id_tanda_tangan=tb_surat.tujuan_utama_id')
            ->join('tb_sifat_naskah', 'tb_sifat_naskah.id_sifat_naskah=tb_surat.sifat_naskah_id')
            ->join('tb_tingkat_urgensi', 'tb_tingkat_urgensi.id_tingkat_urgensi=tb_surat.tingkat_urgensi_id')
            ->join('tb_unit_kerja', 'tb_unit_kerja.id_unit_kerja=tb_surat.unit_kerja_id')
            ->join('tb_bidang', 'tb_bidang.id_bidang=tb_surat.bidang_id');
    }
    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}
