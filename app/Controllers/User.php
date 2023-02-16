<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{

    protected $user_db;

    public function __construct()
    {
        $this->user_db = new UserModel();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {

            $session = session();
            if ($session->get('username')) {

                $id = $session->get('id_users');

                $data_user = new UserModel();


                $data = [
                    'user' => $data_user->where('id_users', $id)->first()
                ];

                $msg = [
                    'data' => view('modal/editUser', $data)
                ];

                echo json_encode($msg);
            } else {
                exit('anda Harus Login !!!');
            }
        } else {
            return view('menu/error');
        }
    }

    public function proses_edit()
    {
        if ($this->request->isAJAX()) {

            $session = session();
            if ($session->get('username')) {
                // kode anda
                $validation = \Config\Services::validation();

                $valid = $this->validate([
                    'username' => [
                        'label' => 'Username',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'password_lama' => [
                        'label' => 'Password Lama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'password_baru' => [
                        'label' => 'Password Baru',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                        ]
                    ],
                    'password_konfirmasi' => [
                        'label' => 'Konfirmasi Password',
                        'rules' => 'required|matches[password_baru]',
                        'errors' => [
                            'required' => '{field} Tidak Boleh Kosong',
                            'matches' => '{field} Harus sama dengan Password Baru'
                        ]
                    ]

                ]);

                if (!$valid) {
                    $msg = [
                        'error' => [
                            'username' => $validation->getError('username'),
                            'password_lama' => $validation->getError('password_lama'),
                            'password_baru' => $validation->getError('password_baru'),
                            'password_konfirmasi' => $validation->getError('password_konfirmasi')
                        ]
                    ];
                } else {

                    $password_lama = $this->request->getVar('password_lama');

                    $id = $this->request->getVar('id');

                    $usermodel = new UserModel();

                    $data = $usermodel->where('id_users', $id)->first();

                    if ($data) {
                        $pass_lama = $data['password'];
                        $verifikasi_pass = password_verify($password_lama, $pass_lama);
                        if ($verifikasi_pass) {

                            // $id = $this->request->getVar('id');

                            $data_update = [
                                'username' => $this->request->getVar('username'),
                                'password' => password_hash($this->request->getVar('password_baru'), PASSWORD_DEFAULT),
                            ];

                            $this->user_db->update($id, $data_update);

                            $msg = [
                                'sukses' => 'Berhasil Update Data'
                            ];
                        } else {
                            $msg = [
                                'error' => [
                                    'login' => 'Password Lama Anda Salah'
                                ]
                            ];
                        }
                    } else {
                        $msg = [
                            'error' => [
                                'login' => 'Update Username/Password Anda Gagal'
                            ]
                        ];
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
}
