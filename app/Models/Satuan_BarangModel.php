<?php

namespace App\Models;

use CodeIgniter\Model;

class Satuan_BarangModel extends Model
{
    protected $table      = '_satuan';
    protected $primaryKey = 'id_satuan';
    protected $returnType     = 'object';
    protected $allowedFields = ['id_satuan', 'satuan'];

    public function tampilBarang()
    {
        return $this->findAll();
    }
}
