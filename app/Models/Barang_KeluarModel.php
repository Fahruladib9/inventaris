<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang_KeluarModel extends Model
{
    protected $table      = 'barang_keluar';
    protected $primaryKey = 'id_barangKeluar';
    protected $returnType     = 'object';
    protected $allowedFields = [
        'id_barangKeluar',
        'kode_transaksi',
        'nama_barang',
        'jumlah',
        'keterangan',
        'tanggal'
    ];

    public function kodeTransaksiTerakhir()
    {
        return $this->select('kode_transaksi')->orderBy('id_barangKeluar', 'DESC')->first();
    }
}
