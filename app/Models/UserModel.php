<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "users";

    protected $primaryKey = "id";

    protected $allowedField = [
        "username",
        "password",
        "role",
        "profile_picture",
        "createddate",
        "updateddate",
        "createdby",
        "updatedby",
        "email",
    ];

    public function authenticate($username, $password)
    {
        return $this->db->table('users')
            ->where('username', $username)
            ->where('password', $password) // sementara (tanpa hash)
            ->get()
            ->getRow(); 
    }
}
