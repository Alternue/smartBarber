<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role',
        'createddate',
        'updateddate'
    ];

    // ====== LOGIN (JANGAN DIHAPUS) ======
    public function authenticate($username, $password)
    {
        return $this->where('username', $username)
                    ->where('password', md5($password)) // sesuai script temanmu
                    ->first();
    }

    // ====== REGISTER ======
    public function insertUser($data)
    {
        return $this->insert($data);
    }
}
