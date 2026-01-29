<?php

namespace App\Controllers;

use App\Models\UserModel;


class AppController extends BaseController
{

    protected $session;
    protected $user;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->user = new UserModel();
    }

    public function index()
    {
        if (session()->has('isLoggedin') === true) {
            $data['title'] = "Potong rambut cukurukuk";
            $data['username'] = session('username');
            return view('dashboard/user', $data);
        } else {
            return view('auth/login');
        }
    }
}
