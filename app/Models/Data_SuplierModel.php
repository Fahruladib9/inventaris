<?php

namespace App\Models;

use CodeIgniter\Model;

class Data_SuplierModel extends Model
{
    protected $table      = '_dataSuplier';
    protected $primaryKey = 'id_dataSuplier';
    protected $returnType     = 'object';
    protected $allowedFields = ['id_dataSuplier', 'suplier'];

    public function tampilData()
    {
        return $this->findAll();
    }
}
