<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard User',
            'username' => session()->get('username') ?? 'User'
        ];

        return view('dashboard/user/index', $data);
    }
}
