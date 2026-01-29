<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{

    protected $user;
    protected $login;

    protected $db;

    protected $session;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->user = new UserModel();
        $this->session = \Config\Services::session();
    }
    public function login()
    {
        return view('auth/login');
    }


    public function authenticate()
    {
        # fungsi untuk menginisiasi db transaction
        $this->db->transBegin();
        try {
            # mengambil data yang dikirim dari view via getPost
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            # insiasi apabila password dan username tidak diisi
            if (empty($username) || empty($password)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Semua field harus diisi.'
                ]);
            }

            # query untuk mengautentikasi user 
            $validate = $this->user->authenticate($username, $password);
            if (!$validate) {
                $this->db->transRollback();
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data pengguna tidak ditemukan'
                ]);
            } else {
                # respon apabila db transaction berhasil
                $this->db->transCommit();
                $session = session();
                $session->set([
                    'isLoggedin' => true,
                ]);
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Login Success',
                    'redirect' => base_url('dashboard')
                ]);
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        session()->destroy();

        return $this->response->setJSON([
            'status' => 'success',
            'redirect' => base_url('login')
        ]);
    }
}
