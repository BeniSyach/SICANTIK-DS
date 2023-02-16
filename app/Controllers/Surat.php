<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\JenisNaskahModel;
use App\Models\KlasifikasiNaskahModel;
use App\Models\PendataTanganModel;
use App\Models\SuratModel;
use App\Models\ServerSideSurat;
use App\Models\SifatNaskahModel;
use App\Models\TingkatUrgensiModel;
use App\Models\UnitKerjaModel;
use App\Models\UserModel;
use Config\Services;

class Surat extends BaseController
{

    protected $suratModel;
    protected $dkrm_melalui;
    protected $jns_naskah;
    protected $sft_naskah;
    protected $tngkt_urgen;
    protected $klasifikasi;
    protected $dikirim;

    public function __construct()
    {
        $this->suratModel = new SuratModel();
        $this->dkrm_melalui = new UnitKerjaModel();
        $this->jns_naskah = new JenisNaskahModel();
        $this->klasifikasi = new KlasifikasiNaskahModel();
        $this->sft_naskah = new SifatNaskahModel();
        $this->tngkt_urgen = new TingkatUrgensiModel();
        $this->dikirim = new PendataTanganModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Halaman Utama | Naskah Keluar'
        ];
        return view('menu/index', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $data = [

                'surat' => $this->suratModel->findAll()
            ];
            $msg = [
                'data' => view('menu/data_surat', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Data Anda TIdak Dapat Di proses');
        }
    }

    public function listdata()
    {
        $request = Services::request();
        $datamodel = new ServerSideSurat($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            $nomor = 1;
            $session = session();
            foreach ($lists as $list) {

                $row = [];

                if (!$session->get('username')) {

                    $unduh = "<a class=\"badge badge-success btn-sm\" href=\"" . base_url('uploads/file_naskah/' . $list->file_naskah) . "\" target=\"_blank\" title=\"Download Surat \"><i class=\"fas fa-download\"></i></a>";

                    $lihat = "<a class=\"badge badge-primary btn-sm\" onclick=\"lihat('" . $list->id . "')\" title=\"Lihat PendataTangan \"><i class=\"fas fa-eye\"></i></a>";

                    $tingkat_urgensi_segera = "<div class=\"badge badge-secondary\"> Segera </div>";
                    $tingkat_urgensi_penting = "<div class=\"badge badge-info\"> Penting</div>";

                    $sifat_naskah_rahasia = "<div class=\"badge badge-warning\"> Rahasia </div>";
                    $sifat_naskah_penting = "<div class=\"badge badge-primary\"> Penting </div>";
                    $sifat_naskah_biasa = "<div class=\"badge badge-success\"> Biasa </div>";

                    $row[] = $nomor++;
                    $row[] = date('d-m-Y', strtotime($list->tanggal_naskah));
                    $row[] = $list->nama_bidang;
                    $row[] = $list->nomor_naskah;
                    $row[] = $list->hal;

                    $row[] = $list->nama_unit_kerja;
                    $row[] = $list->tujuan_naskah;

                    if ($list->tingkat_urgensi == 'Penting') {
                        $row[] =  $tingkat_urgensi_penting;
                    } else {
                        $row[] =   $tingkat_urgensi_segera;
                    }
                    if ($list->sifat_naskah == 'Rahasia') {
                        $row[] =  $sifat_naskah_rahasia;
                    } else if ($list->sifat_naskah == 'Penting') {
                        $row[] =  $sifat_naskah_penting;
                    } else {
                        $row[] =  $sifat_naskah_biasa;
                    }

                    if ($list->sifat_naskah == 'Rahasia' || $list->sifat_naskah == 'Penting') {
                        $row[] = $lihat;
                    } else {
                        $row[] = $unduh . "  " . $lihat;
                    }

                    $data[] = $row;
                } else if ($session->get('username')) {

                    if ($session->get('bidang_id') == '0') {

                        $unduh = "<a class=\"badge badge-success btn-sm\" href=\"" . base_url('uploads/file_naskah/' . $list->file_naskah) . "\" target=\"_blank\" title=\"Download Surat \"><i class=\"fas fa-download\"></i></a>";

                        $lihat = "<a class=\"badge badge-primary btn-sm\" onclick=\"lihat('" . $list->id . "')\" title=\"Lihat PendataTangan \"><i class=\"fas fa-eye\"></i></a>";


                        // $tomboledit = "<a class=\"badge badge-danger btn-sm\" onclick=\"edit('" . $list->id . "')\" title=\"Edit Data \"><i class=\"fas fa-edit\"></i></a>";

                        $tombolhapus = "<a class=\"badge badge-danger btn-sm\" onclick=\"hapus('" . $list->id . "')\" title=\"Hapus Data \"><i class=\"fas fa-trash-alt\"></i></a>";

                        $tingkat_urgensi_segera = "<div class=\"badge badge-light\"> Segera </div>";
                        $tingkat_urgensi_penting = "<div class=\"badge badge-info\"> Penting</div>";

                        $sifat_naskah_rahasia = "<div class=\"badge badge-warning\"> Rahasia </div>";
                        $sifat_naskah_penting = "<div class=\"badge badge-primary\"> Penting </div>";
                        $sifat_naskah_biasa = "<div class=\"badge badge-success\"> Biasa </div>";

                        $row[] = $nomor++;
                        $row[] = date('d-m-Y', strtotime($list->tanggal_naskah));
                        $row[] = $list->nama_bidang;
                        $row[] = $list->nomor_naskah;
                        $row[] = $list->hal;
                        $row[] = $list->nama_unit_kerja;
                        $row[] = $list->tujuan_naskah;
                        if ($list->sifat_naskah == 'Penting') {
                            $row[] =  $tingkat_urgensi_penting;
                        } else {
                            $row[] =   $tingkat_urgensi_segera;
                        }
                        if ($list->sifat_naskah == 'Rahasia') {
                            $row[] =  $sifat_naskah_rahasia;
                        } else if ($list->sifat_naskah == 'Penting') {
                            $row[] =  $sifat_naskah_penting;
                        } else {
                            $row[] =  $sifat_naskah_biasa;
                        }
                        $row[] = $tombolhapus . "      " . $unduh . "  " . $lihat;
                        $data[] = $row;
                    }
                    if ($list->bidang_id == $session->get('bidang_id')) {


                        $unduh = "<a class=\"badge badge-success btn-sm\" href=\"" . base_url('uploads/file_naskah/' . $list->file_naskah) . "\" target=\"_blank\" title=\"Download Surat \"><i class=\"fas fa-download\"></i></a>";

                        $lihat = "<a class=\"badge badge-primary btn-sm\" onclick=\"lihat('" . $list->id . "')\" title=\"Lihat PendataTangan \"><i class=\"fas fa-eye\"></i></a>";


                        // $tomboledit = "<a class=\"badge badge-danger btn-sm\" onclick=\"edit('" . $list->id . "')\" title=\"Edit Data \"><i class=\"fas fa-edit\"></i></a>";

                        $tombolhapus = "<a class=\"badge badge-danger btn-sm\" onclick=\"hapus('" . $list->id . "')\" title=\"Hapus Data \"><i class=\"fas fa-trash-alt\"></i></a>";

                        $tingkat_urgensi_segera = "<div class=\"badge badge-light\"> Segera </div>";
                        $tingkat_urgensi_penting = "<div class=\"badge badge-info\"> Penting</div>";

                        $sifat_naskah_rahasia = "<div class=\"badge badge-warning\"> Rahasia </div>";
                        $sifat_naskah_penting = "<div class=\"badge badge-primary\"> Penting </div>";
                        $sifat_naskah_biasa = "<div class=\"badge badge-success\"> Biasa </div>";

                        $row[] = $nomor++;
                        $row[] = date('d-m-Y', strtotime($list->tanggal_naskah));
                        $row[] = $list->nama_bidang;
                        $row[] = $list->nomor_naskah;
                        $row[] = $list->hal;
                        $row[] = $list->nama_unit_kerja;
                        $row[] = $list->tujuan_naskah;
                        if ($list->sifat_naskah == 'Penting') {
                            $row[] =  $tingkat_urgensi_penting;
                        } else {
                            $row[] =   $tingkat_urgensi_segera;
                        }
                        if ($list->sifat_naskah == 'Rahasia') {
                            $row[] =  $sifat_naskah_rahasia;
                        } else if ($list->sifat_naskah == 'Penting') {
                            $row[] =  $sifat_naskah_penting;
                        } else {
                            $row[] =  $sifat_naskah_biasa;
                        }
                        $row[] = $tombolhapus . "      " . $unduh . "  " . $lihat;
                        $data[] = $row;
                    }
                } else {
                    exit('Tidak Ada Data');
                }
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            if ($session->get('username')) {

                $dkrm_melalui = new UnitKerjaModel();
                $jns_naskah = new JenisNaskahModel();
                $klasifikasi = new KlasifikasiNaskahModel();
                $sft_naskah = new SifatNaskahModel();
                $tngkt_urgen = new TingkatUrgensiModel();
                $dikirim = new PendataTanganModel();

                $data = [
                    'dkrm_melalui' => $dkrm_melalui->findAll(),
                    'jns_naskah' => $jns_naskah->findAll(),
                    'klasifikasi' => $klasifikasi->findAll(),
                    'sft_naskah' => $sft_naskah->findAll(),
                    'tngkt_urgen' => $tngkt_urgen->findAll(),
                    'dikirim' => $dikirim->findAll(),

                ];

                $msg = [
                    'data' => view('modal/create', $data)
                ];

                echo json_encode($msg);
            } else {
                exit('anda Harus Login !!!');
            }
        } else {
            return view('menu/error');
        }
    }


    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            if ($session->get('username')) {

                $validation = \Config\Services::validation();


                $cek_tanda_tangan = $this->request->getVar('tujuan_utama');

                if ($cek_tanda_tangan == 'tambah_tanda_tangan') {

                    $valid_tanda_tangan = $this->validate([
                        'tgl_naskah' => [
                            'label' => 'Tanggal Naskah',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'dkrm_melalui' => [
                            'label' => 'Unit Kerja',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'jenis_naskah' => [
                            'label' => 'Jenis Naskah',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'sifat_naskah' => [
                            'label' => 'Sifat Naskah',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'tingkat_urgensi' => [
                            'label' => 'Tingkat Urgensi',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'klasifikasi' => [
                            'label' => 'Klasifikasi',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'nomor_naskah' => [
                            'label' => 'Nomor Naskah',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'lampiran_naskah' => [
                            'label' => 'Lampiran Naskah',
                            'rules' => [
                                // 'required',
                                'mime_in[application/excel]',
                                'max_size[lampiran_naskah,20000]',
                            ], 'errors' => [
                                // 'required' => '{field} Tidak Boleh Kosong',
                                'mime_in' => '{field} Input Harus Tipe gambar atau Dokumen',
                                'max_size' => '{field} File Melebihi Batas 20 MB'
                            ]
                        ],
                        'hal' => [
                            'label' => 'Hal',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'tujuan_naskah' => [
                            'label' => 'Tujuan Utama',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'file_naskah' => [
                            'label' => 'File Naskah',
                            'rules' => [
                                // 'required',
                                'mime_in[file_naskah,application/pdf]',
                                'max_size[file_naskah,20000]',
                            ], 'errors' => [
                                // 'required' => '{field} Tidak Boleh Kosong',
                                'mime_in' => '{field} harus berjenis PDF',
                                'max_size' => '{field} Melebihi Batas Ukuran 20 MB'
                            ]
                        ],
                        'tujuan_utama' => [
                            'label' => 'Penandatangan',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'nama_tanda_tangan' => [
                            'label' => 'Nama Tanda Tangan',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'nip' => [
                            'label' => 'NIP',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'jabatan' => [
                            'label' => 'Jabatan',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'golongan' => [
                            'label' => 'Golongan',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'foto' => [
                            'label' => 'Foto',
                            'rules' => [
                                // 'required',
                                'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                                'max_size[foto,5000]',
                            ], 'errors' => [
                                // 'required' => '{field} Tidak Boleh Kosong',
                                'mime_in' => '{field} harus berjenis PDF',
                                'max_size' => '{field} Melebihi Batas Ukuran 5 MB'
                            ]
                        ],
                    ]);

                    if (!$valid_tanda_tangan) {
                        $msg = [
                            'error' => [
                                'tgl_naskah' => $validation->getError('tgl_naskah'),
                                'dkrm_melalui' => $validation->getError('dkrm_melalui'),
                                'jenis_naskah' => $validation->getError('jenis_naskah'),
                                'sifat_naskah' => $validation->getError('sifat_naskah'),
                                'tingkat_urgensi' => $validation->getError('tingkat_urgensi'),
                                'klasifikasi' => $validation->getError('klasifikasi'),
                                'nomor_naskah' => $validation->getError('nomor_naskah'),
                                'hal' => $validation->getError('hal'),
                                'tujuan_naskah' => $validation->getError('tujuan_naskah'),
                                'tujuan_utama' => $validation->getError('tujuan_utama'),
                                'file_naskah' => $validation->getError('file_naskah'),
                                'lampiran_naskah' => $validation->getError('lampiran_naskah'),
                                'nama_tanda_tangan' => $validation->getError('nama_tanda_tangan'),
                                'nip' => $validation->getError('nip'),
                                'jabatan' => $validation->getError('jabatan'),
                                'golongan' => $validation->getError('golongan'),
                                'foto' => $validation->getError('foto'),
                            ]
                        ];
                    } else {
                        $tanda_tangan_id = new PendataTanganModel();
                        $tujuan_utama = $tanda_tangan_id->id_terakhir();

                        $tambah_tujuan_utama = $tujuan_utama['id_tanda_tangan'] + 1;

                        $dokumenFile = $this->request->getFile('file_naskah');
                        $nama_file = $dokumenFile->getClientName();
                        $dokumenFile->move('uploads/file_naskah',  $nama_file);

                        $lampiranFile = $this->request->getFile('lampiran_naskah');
                        $dokumenLampiran = $lampiranFile->getClientName();
                        $lampiranFile->move('uploads/lampiran_naskah',  $dokumenLampiran);

                        $id_bidang = session()->get('bidang_id');
                        $id_user = session()->get('id_users');

                        $simpandata = [
                            'tanggal_naskah' => $this->request->getVar('tgl_naskah'),
                            'unit_kerja_id' => $this->request->getVar('dkrm_melalui'),
                            'jenis_naskah_id' => $this->request->getVar('jenis_naskah'),
                            'sifat_naskah_id' => $this->request->getVar('sifat_naskah'),
                            'tingkat_urgensi_id' => $this->request->getVar('tingkat_urgensi'),
                            'klasifikasi_id' => $this->request->getVar('klasifikasi'),
                            'nomor_naskah' => $this->request->getVar('nomor_naskah'),
                            'lampiran_naskah'  => $lampiranFile->getClientName(),
                            // 'lampiran_naskah' => $this->request->getVar('lampiran_naskah'),
                            'hal' => $this->request->getVar('hal'),
                            'file_naskah'  => $dokumenFile->getClientName(),
                            // 'file_naskah' => $this->request->getVar('file_naskah'),
                            'tujuan_naskah' => $this->request->getVar('tujuan_naskah'),
                            'tujuan_utama_id' => $tambah_tujuan_utama,
                            'bidang_id' => $id_bidang,
                            'user_id' => $id_user
                        ];

                        $this->suratModel->insert($simpandata);

                        $foto = $this->request->getFile('foto');
                        $nama_file = $foto->getClientName();
                        $foto->move('assets/img',  $nama_file);

                        $data_penandatangan = [
                            'nama_tanda_tangan' => $this->request->getVar('nama_tanda_tangan'),
                            'nip' => $this->request->getVar('nip'),
                            'jabatan' => $this->request->getVar('jabatan'),
                            'golongan' => $this->request->getVar('golongan'),
                            'gambar' => $nama_file
                        ];

                        $this->dikirim->insert($data_penandatangan);

                        $msg = [
                            'sukses' => 'Surat berhasil disimpan'
                        ];
                    }
                } else {

                    $valid = $this->validate([
                        'tgl_naskah' => [
                            'label' => 'Tanggal Naskah',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'dkrm_melalui' => [
                            'label' => 'Unit Kerja',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'jenis_naskah' => [
                            'label' => 'Jenis Naskah',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'sifat_naskah' => [
                            'label' => 'Sifat Naskah',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'tingkat_urgensi' => [
                            'label' => 'Tingkat Urgensi',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'klasifikasi' => [
                            'label' => 'Klasifikasi',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'nomor_naskah' => [
                            'label' => 'Nomor Naskah',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'lampiran_naskah' => [
                            'label' => 'Lampiran Naskah',
                            'rules' => [
                                // 'required',
                                'mime_in[lampiran_naskah,image/jpg,image/jpeg,image/gif,image/png,image/webp,application/pdf,application/msword]',
                                'max_size[lampiran_naskah,20000]',
                            ], 'errors' => [
                                // 'required' => '{field} Tidak Boleh Kosong',
                                'mime_in' => '{field} Input Harus Tipe gambar atau Dokumen',
                                'max_size' => '{field} File Melebihi Batas 20 MB'
                            ]
                        ],
                        'hal' => [
                            'label' => 'Hal',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'tujuan_naskah' => [
                            'label' => 'Tujuan Utama',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],
                        'file_naskah' => [
                            'label' => 'File Naskah',
                            'rules' => [
                                // 'required',
                                'mime_in[file_naskah,application/pdf]',
                                'max_size[file_naskah,20000]',
                            ], 'errors' => [
                                // 'required' => '{field} Tidak Boleh Kosong',
                                'mime_in' => '{field} harus berjenis PDF',
                                'max_size' => '{field} Melebihi Batas Ukuran 20 MB'
                            ]
                        ],
                        'tujuan_utama' => [
                            'label' => 'Penandatangan',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Tidak Boleh Kosong',
                            ]
                        ],

                    ]);

                    if (!$valid) {
                        $msg = [
                            'error' => [
                                'tgl_naskah' => $validation->getError('tgl_naskah'),
                                'dkrm_melalui' => $validation->getError('dkrm_melalui'),
                                'jenis_naskah' => $validation->getError('jenis_naskah'),
                                'sifat_naskah' => $validation->getError('sifat_naskah'),
                                'tingkat_urgensi' => $validation->getError('tingkat_urgensi'),
                                'klasifikasi' => $validation->getError('klasifikasi'),
                                'nomor_naskah' => $validation->getError('nomor_naskah'),
                                'hal' => $validation->getError('hal'),
                                'tujuan_naskah' => $validation->getError('tujuan_naskah'),
                                'tujuan_utama' => $validation->getError('tujuan_utama'),
                                'file_naskah' => $validation->getError('file_naskah'),
                                'lampiran_naskah' => $validation->getError('lampiran_naskah'),

                            ]
                        ];
                    } else {

                        $dokumenFile = $this->request->getFile('file_naskah');
                        $nama_file = $dokumenFile->getClientName();
                        $dokumenFile->move('uploads/file_naskah',  $nama_file);

                        // $lampiranFile = $this->request->getFile('lampiran_naskah');
                        if ($this->request->getFile('lampiran_naskah') == "") {


                            $id_bidang = session()->get('bidang_id');
                            $id_user = session()->get('id_users');

                            $simpandata = [
                                'tanggal_naskah' => $this->request->getVar('tgl_naskah'),
                                'unit_kerja_id' => $this->request->getVar('dkrm_melalui'),
                                'jenis_naskah_id' => $this->request->getVar('jenis_naskah'),
                                'sifat_naskah_id' => $this->request->getVar('sifat_naskah'),
                                'tingkat_urgensi_id' => $this->request->getVar('tingkat_urgensi'),
                                'klasifikasi_id' => $this->request->getVar('klasifikasi'),
                                'nomor_naskah' => $this->request->getVar('nomor_naskah'),
                                'lampiran_naskah'  => null,
                                // 'lampiran_naskah' => $this->request->getVar('lampiran_naskah'),
                                'hal' => $this->request->getVar('hal'),
                                'file_naskah'  => $dokumenFile->getClientName(),
                                // 'file_naskah' => $this->request->getVar('file_naskah'),
                                'tujuan_naskah' => $this->request->getVar('tujuan_naskah'),
                                'tujuan_utama_id' => $this->request->getVar('tujuan_utama'),
                                'bidang_id' => $id_bidang,
                                'user_id' => $id_user
                            ];

                            $this->suratModel->insert($simpandata);
                            $msg = [
                                'sukses' => 'Surat berhasil disimpan'
                            ];
                        } else {
                            $lampiranFile = $this->request->getFile('lampiran_naskah');
                            $dokumenLampiran = $lampiranFile->getClientName();
                            $lampiranFile->move('uploads/lampiran_naskah',  $dokumenLampiran);


                            $id_bidang = session()->get('bidang_id');
                            $id_user = session()->get('id_users');

                            $simpandata = [
                                'tanggal_naskah' => $this->request->getVar('tgl_naskah'),
                                'unit_kerja_id' => $this->request->getVar('dkrm_melalui'),
                                'jenis_naskah_id' => $this->request->getVar('jenis_naskah'),
                                'sifat_naskah_id' => $this->request->getVar('sifat_naskah'),
                                'tingkat_urgensi_id' => $this->request->getVar('tingkat_urgensi'),
                                'klasifikasi_id' => $this->request->getVar('klasifikasi'),
                                'nomor_naskah' => $this->request->getVar('nomor_naskah'),
                                'lampiran_naskah'  => $dokumenLampiran,
                                // 'lampiran_naskah' => $this->request->getVar('lampiran_naskah'),
                                'hal' => $this->request->getVar('hal'),
                                'file_naskah'  => $dokumenFile->getClientName(),
                                // 'file_naskah' => $this->request->getVar('file_naskah'),
                                'tujuan_naskah' => $this->request->getVar('tujuan_naskah'),
                                'tujuan_utama_id' => $this->request->getVar('tujuan_utama'),
                                'bidang_id' => $id_bidang,
                                'user_id' => $id_user
                            ];

                            $this->suratModel->insert($simpandata);
                            $msg = [
                                'sukses' => 'Surat berhasil disimpan'
                            ];
                        }
                    }
                }


                echo json_encode($msg);
            } else {
                exit('anda Harus Login !!!');
            }
        } else {
            return view('menu/error');
        }
    }


    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            if ($session->get('username')) {
                $dkrm_melalui = new UnitKerjaModel();
                $jns_naskah = new JenisNaskahModel();
                $klasifikasi = new KlasifikasiNaskahModel();
                $sft_naskah = new SifatNaskahModel();
                $tngkt_urgen = new TingkatUrgensiModel();
                $dikirim = new PendataTanganModel();

                $id = $this->request->getVar('id');

                $row = $this->suratModel->cari($id);



                $data = [
                    'dkrm_melalui' => $dkrm_melalui->findAll(),
                    'jns_naskah' => $jns_naskah->findAll(),
                    'klasifikasi' => $klasifikasi->findAll(),
                    'sft_naskah' => $sft_naskah->findAll(),
                    'tngkt_urgen' => $tngkt_urgen->findAll(),
                    'dikirim' => $dikirim->findAll(),
                    'id' => $row['id'],
                    'tanggal_naskah' => $row['tanggal_naskah'],
                    'nama_unit_kerja' => $row['nama_unit_kerja'],
                    'jenis_naskah' => $row['jenis_naskah'],
                    'sifat_naskah' => $row['sifat_naskah'],
                    'tingkat_urgensi' => $row['tingkat_urgensi'],
                    'nama_klasifikasi' => $row['nama_klasifikasi'],
                    'nomor_naskah' => $row['nomor_naskah'],
                    'lampiran_naskah' => $row['lampiran_naskah'],
                    'hal' => $row['hal'],
                    'file_naskah' => $row['file_naskah'],
                    'tujuan_utama' => $row['tujuan_naskah'],
                    'nama_tanda_tangan' => $row['nama_tanda_tangan']
                ];

                $msg = [
                    'sukses' => view('modal/edit', $data)
                ];

                echo json_encode($msg);
            } else {
                exit('anda Harus Login !!!');
            }
        } else {
            return view('menu/error');
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $row = $this->suratModel->cari($id);

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'tgl_naskah' => [
                    'label' => 'Tanggal Naskah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'dkrm_melalui' => [
                    'label' => 'Unit Kerja',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jenis_naskah' => [
                    'label' => 'Jenis Naskah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'sifat_naskah' => [
                    'label' => 'Sifat Naskah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tingkat_urgensi' => [
                    'label' => 'Tingkat Urgensi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'klasifikasi' => [
                    'label' => 'Klasifikasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'nomor_naskah' => [
                    'label' => 'Nomor Naskah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'hal' => [
                    'label' => 'Hal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tujuan_utama' => [
                    'label' => 'Tujuan Utama Pendata Tangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'file_naskah' => [
                    'label' => 'File Naskah',
                    'rules' => [
                        'mime_in[file_naskah,application/pdf]',
                        'max_size[file_naskah,20000]',
                    ], 'errors' => [
                        'mime_in' => '{field} harus berjenis PDF',
                        'max_size' => '{field} Melebihi Batas Ukuran 20 MB'
                    ]
                ],
                'lampiran_naskah' => [
                    'label' => 'Lampiran Naskah',
                    'rules' => [
                        'mime_in[lampiran_naskah,image/jpg,image/jpeg,image/gif,image/png,image/webp,application/pdf,application/msword]',
                        'max_size[lampiran_naskah,20000]',
                    ], 'errors' => [
                        'mime_in' => '{field} Input Harus Tipe gambar atau Dokumen',
                        'max_size' => '{field} File Melebihi Batas 20 MB'
                    ]
                ],

            ]);


            if (!$valid) {
                $msg = [
                    'error' => [
                        'tgl_naskah' => $validation->getError('tgl_naskah'),
                        'dkrm_melalui' => $validation->getError('dkrm_melalui'),
                        'jenis_naskah' => $validation->getError('jenis_naskah'),
                        'sifat_naskah' => $validation->getError('sifat_naskah'),
                        'tingkat_urgensi' => $validation->getError('tingkat_urgensi'),
                        'klasifikasi' => $validation->getError('klasifikasi'),
                        'nomor_naskah' => $validation->getError('nomor_naskah'),
                        'hal' => $validation->getError('hal'),
                        'tujuan_naskah' => $validation->getError('tujuan_naskah'),
                        'tujuan_utama' => $validation->getError('tujuan_utama'),
                    ]
                ];
            } else {
                if ($this->request->getFile('file_naskah') == $row['file_naskah'] ||  $this->request->getFile('file_naskah') == null) {
                    $nama_file =  $this->request->getVar($row['file_naskah']);
                } else {
                    $nama_file = $row['file_naskah'];
                    unlink('uploads/file_naskah', $nama_file);

                    $dokumenFile = $this->request->getFile('file_naskah');
                    $nama_file = $dokumenFile->getClientName();
                    $dokumenFile->move('uploads/file_naskah',  $nama_file);
                }

                if ($this->request->getFile('lampiran_naskah') == $row['lampiran_naskah'] || $this->request->getFile('lampiran_naskah') == null) {
                    $nama_lampiran =  $this->request->getVar($row['lampiran_naskah']);
                } else {
                    $nama_file = $row['lampiran_naskah'];
                    unlink('uploads/lampiran_naskah', $nama_file);

                    $lampiranFile = $this->request->getFile('lampiran_naskah');
                    $nama_lampiran = $lampiranFile->getClientName();
                    $lampiranFile->move('uploads/lampiran_naskah',  $nama_lampiran);
                }

                $simpandata = [
                    'tanggal_naskah' => $this->request->getVar('tgl_naskah'),
                    'unit_kerja_id' => $this->request->getVar('dkrm_melalui'),
                    'jenis_naskah_id' => $this->request->getVar('jenis_naskah'),
                    'sifat_naskah_id' => $this->request->getVar('sifat_naskah'),
                    'tingkat_urgensi_id' => $this->request->getVar('tingkat_urgensi'),
                    'klasifikasi_id' => $this->request->getVar('klasifikasi'),
                    'nomor_naskah' => $this->request->getVar('nomor_naskah'),
                    'lampiran_naskah'  => $nama_lampiran,
                    'hal' => $this->request->getVar('hal'),
                    'file_naskah'  => $nama_file,
                    'tujuan_naskah' => $this->request->getVar('tujuan_naskah'),
                    'tujuan_utama_id' => $this->request->getVar('tujuan_utama')
                ];


                $this->suratModel->update($id, $simpandata);

                $msg = [
                    'sukses' => 'Surat berhasil di Ubah'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Anda TIdak Dapat Di proses');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            if ($session->get('username')) {

                $id = $this->request->getVar('id');

                $row = $this->suratModel->cari($id);

                if (is_file('/uploads/file_naskah/' . $row['file_naskah'])) {
                    chmod('/uploads/file_naskah/' . $row['file_naskah'], 777);
                    unlink('/uploads/file_naskah/', $row['file_naskah']);
                }

                if (is_file('/uploads/file_naskah/' . $row['lampiran_naskah'])) {
                    chmod('/uploads/file_naskah/' . $row['lampiran_naskah'], 777);
                    unlink('/uploads/file_naskah/', $row['lampiran_naskah']);
                }

                $this->suratModel->delete($id);

                $msg = [
                    'sukses' => 'Surat berhasil di hapus'
                ];

                echo json_encode($msg);
            } else {
                exit('anda Harus Login !!!');
            }
        } else {
            return view('menu/error');
        }
    }


    public function tanda_tangan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $row = $this->suratModel->cari($id);
            $data = [
                'nama_tanda_tangan' => $row['nama_tanda_tangan'],
                'golongan' => $row['golongan'],
                'jabatan' => $row['jabatan'],
                'nip' => $row['nip'],
                'gambar' => $row['gambar']
            ];
            $msg = [
                'sukses' => view('modal/tanda_tangan', $data)
            ];

            echo json_encode($msg);
        } else {
            return view('menu/error');
        }
    }


    public function cari_surat()
    {
        $cari_naskah = $this->request->getVar('input_nomor');

        if ($this->suratModel->cari_naskah($cari_naskah)) {
            $data = [
                'data_table' => $this->suratModel->cari_naskah($cari_naskah)
            ];

            $msg = [
                'sukses' => view('menu/hasil_cari', $data)
            ];
        } else {
            $msg = [
                'error' => 'Naskah Yang Anda Cari Tidak Tersedia'
            ];
        }

        echo json_encode($msg);
    }
}
