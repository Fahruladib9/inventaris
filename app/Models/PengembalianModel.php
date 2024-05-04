<?php

namespace App\Models;

use CodeIgniter\Model;

class PengembalianModel extends Model
{
    protected $table      = '_pengembalian';
    protected $primaryKey = 'id_pengembalian';
    protected $returnType     = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'id_pengembalian',
        'id_stokBarang',
        'id_peminjaman',
        'id_user',
        'nama_user',
        'kode_pengembalian',
        'nama_barang',
        'jumlah',
        'created_at',
        'status',
    ];

    public function ambilData()
    {
        // ambil data berdasarkan user yang lagi login
        $user = session('user');
        return $this->where([
            'id_user' => $user['id_user'],
        ])->orderBy('id_pengembalian', 'DESC')->findAll();
    }
    public function ambilKodePengembalian()
    {
        return $this->select('kode_pengembalian')->orderBy('id_pengembalian', 'DESC')->first();
    }
}
