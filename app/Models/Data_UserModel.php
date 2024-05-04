<?php

namespace App\Models;

use CodeIgniter\Model;

class Data_UserModel extends Model
{
    protected $table      = '_users';
    protected $primaryKey = 'id_user';
    protected $returnType     = 'object';
    protected $allowedFields = [
        'id_user',
        'username',
        'password',
        'nama',
        'akses',
    ];

    public function tampilData()
    {
        return $this->findAll();
    }

    public function ambil_data_username($username)
    {
        return $this->where('username', $username)->first();
    }
}
