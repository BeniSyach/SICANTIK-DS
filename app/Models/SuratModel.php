<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table      = 'tb_surat';
    protected $allowedFields = ['unit_kerja_id', 'jenis_naskah_id', 'sifat_naskah_id', 'tingkat_urgensi_id', 'klasifikasi_id', 'nomor_naskah', 'hal', 'file_naskah', 'lampiran_naskah', 'tanggal_naskah', 'tujuan_naskah', 'tujuan_utama_id', 'bidang_id', 'user_id'];
    protected $useTimestamps = false;

    public  function cari($id)
    {
        return $this->db->table('tb_surat')
            ->join('tb_jenis_naskah', 'tb_jenis_naskah.id_jenis_naskah=tb_surat.jenis_naskah_id')
            ->join('tb_klasifikasi', 'tb_klasifikasi.id_klasifikasi=tb_surat.klasifikasi_id')
            ->join('tb_pendata_tangan', 'tb_pendata_tangan.id_tanda_tangan=tb_surat.tujuan_utama_id')
            ->join('tb_sifat_naskah', 'tb_sifat_naskah.id_sifat_naskah=tb_surat.sifat_naskah_id')
            ->join('tb_tingkat_urgensi', 'tb_tingkat_urgensi.id_tingkat_urgensi=tb_surat.tingkat_urgensi_id')
            ->join('tb_unit_kerja', 'tb_unit_kerja.id_unit_kerja=tb_surat.unit_kerja_id')
            ->join('tb_bidang', 'tb_bidang.id_bidang=tb_surat.bidang_id')
            ->where(['tb_surat.id' => $id])
            ->get()->getRowArray();
    }

    public  function cari_naskah($cari_naskah)
    {
        return $this->db->table('tb_surat')
            ->join('tb_jenis_naskah', 'tb_jenis_naskah.id_jenis_naskah=tb_surat.jenis_naskah_id')
            ->join('tb_klasifikasi', 'tb_klasifikasi.id_klasifikasi=tb_surat.klasifikasi_id')
            ->join('tb_pendata_tangan', 'tb_pendata_tangan.id_tanda_tangan=tb_surat.tujuan_utama_id')
            ->join('tb_sifat_naskah', 'tb_sifat_naskah.id_sifat_naskah=tb_surat.sifat_naskah_id')
            ->join('tb_tingkat_urgensi', 'tb_tingkat_urgensi.id_tingkat_urgensi=tb_surat.tingkat_urgensi_id')
            ->join('tb_unit_kerja', 'tb_unit_kerja.id_unit_kerja=tb_surat.unit_kerja_id')
            ->where(['tb_surat.nomor_naskah' => $cari_naskah])->get()->getResultArray();
    }

    public function total_upload($tanggal_hari_ini, $bulan_ini, $tahun_ini)
    {
        // return $this->db->table('tb_surat')
        //     ->join('users', 'users.id_users=tb_surat.user_id')
        //     ->join('tb_bidang', 'tb_bidang.id_bidang=tb_surat.bidang_id')
        //     ->get()->getResultArray();

        return $this->db->query("SELECT *,count(if(tanggal_naskah = '$tanggal_hari_ini',1,null )) hari_ini,count(if(CONCAT(YEAR(tanggal_naskah),'-',MONTHNAME(tanggal_naskah)) = '$bulan_ini',1,null )) bulan_ini, count(if(YEAR(tanggal_naskah) = '$tahun_ini',1,null )) tahun_ini FROM tb_surat JOIN users on users.id_users = tb_surat.user_id JOIN tb_bidang on tb_bidang.id_bidang=tb_surat.bidang_id GROUP BY user_id")->getResultArray();
    }
}
