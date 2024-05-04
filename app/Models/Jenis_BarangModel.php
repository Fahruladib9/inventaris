<?php

namespace App\Models;

use CodeIgniter\Model;

class Jenis_BarangModel extends Model
{
    protected $table      = '_jenisbarang';
    protected $primaryKey = 'id_jenisBarang';
    protected $returnType     = 'object';
    protected $allowedFields = ['id_jenisBarang', 'jenis_barang'];

    public function tampilBarang()
    {
        return $this->findAll();
    }
}
