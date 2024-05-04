<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table      = '_peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $returnType     = 'object';
    protected $allowedFields = [
        'id_peminjaman',
        'id_user',
        'id_stokBarang',
        'nama_user',
        'kode_peminjaman',
        'nama_barang',
        'jumlah',
        'keterangan',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status',
    ];

    public function ambilData()
    {
        // ambil data berdasarkan user yang lagi login
        $user = session('user');
        return $this->where([
            'id_user' => $user['id_user'],
        ])->orderBy('id_peminjaman', 'DESC')->findAll();
    }
    public function ambilKodePeminjaman()
    {
        return $this->select('kode_peminjaman')->orderBy('id_peminjaman', 'DESC')->first();
    }
}
