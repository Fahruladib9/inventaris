<?php

namespace App\Models;

use CodeIgniter\Model;

class Stok_BarangModel extends Model
{
    protected $table      = 'stok_barang';
    protected $primaryKey = 'id_stokBarang';
    protected $returnType     = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id_stokBarang',
        'kode_barang',
        'nama_barang',
        'jenis_barang',
        'kondisi',
        'jumlah',
        'jumlah_dipinjam',
        'satuan',
        'updated_at',
    ];

    public function kodeBarangTerakhir()
    {
        return $this->select('kode_barang')->orderBy('id_stokBarang', 'DESC')->first();
    }
    public function CekNamaSama($namaBarang)
    {
        return $this->where('nama_barang', $namaBarang)->first();
    }
}
