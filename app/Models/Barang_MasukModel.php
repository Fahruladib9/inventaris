<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang_MasukModel extends Model
{
    protected $table      = 'barang_masuk';
    protected $primaryKey = 'id_barangMasuk';
    protected $returnType     = 'object';
    protected $allowedFields = [
        'id_barangMasuk',
        'kode_transaksi',
        'nama_barang',
        'suplier',
        'jumlah',
        'tanggal'
    ];

    public function kodeTransaksiTerakhir()
    {
        return $this->select('kode_transaksi')->orderBy('id_barangMasuk', 'DESC')->first();
    }
}
