<?php

namespace App\Controllers;

use App\Models\SuratModel;

class Statistik extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {

            $model_surat = new SuratModel();

            $tanggal_hari_ini = date('Y-m-d');

            $bulan_ini = date('Y-F');

            $tahun_ini = date('Y');

            $data = [
                'data_surat' => $model_surat->total_upload($tanggal_hari_ini, $bulan_ini, $tahun_ini)
            ];

            $msg = [

                'data' => view('modal/statistik_upload', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Data Anda TIdak Dapat Di proses');
        }
    }
}
