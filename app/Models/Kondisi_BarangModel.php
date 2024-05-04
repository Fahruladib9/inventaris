<?php

namespace App\Models;

use CodeIgniter\Model;

class Kondisi_BarangModel extends Model
{
    protected $table      = '_kondisi';
    protected $primaryKey = 'id_kondisi';
    protected $returnType     = 'object';
    protected $allowedFields = ['id_kondisi', 'kondisi'];

    public function tampilBarang()
    {
        return $this->findAll();
    }
}
