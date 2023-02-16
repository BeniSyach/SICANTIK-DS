<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {

            $msg = [

                'data' => view('modal/login')
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Data Anda TIdak Dapat Di proses');
        }
    }

    public function proses_login()
    {
        if ($this->request->isAJAX()) {
            $session = session();
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ]

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password')
                    ]
                ];
            } else {

                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $usermodel = new UserModel();
                $data = $usermodel->where('username', $username)->first();
                if ($data) {
                    $pass = $data['password'];
                    $verifikasi_pass = password_verify($password, $pass);
                    if ($verifikasi_pass) {
                        $ses_data = [
                            'id_users'       => $data['id_users'],
                            'username'     => $data['username'],
                            'bidang_id'    => $data['bidang_id'],
                            'logged_in'     => TRUE
                        ];
                        $session->set($ses_data);

                        $msg = [
                            'sukses' => 'Berhasil Login'
                        ];
                    } else {
                        $msg = [
                            'error' => [
                                'login' => 'Gagal Login'
                            ]
                        ];
                    }
                } else {
                    $msg = [
                        'error' => [
                            'login' => 'Gagal Login'
                        ]
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Data Anda TIdak Dapat Di proses');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
