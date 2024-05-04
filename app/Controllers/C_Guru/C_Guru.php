<?php

namespace App\Controllers\C_Guru;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;

class C_Guru extends BaseController
{
    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->pengembalian = new PengembalianModel();
    }
    public function dashboard()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];
        // jumlah pengajuan peminjaman
        $data['jumlahPengajuanPeminjaman'] = $this->peminjaman->where([
            'id_user' => $user['id_user'],
            'status' => 'diproses',
        ])->selectCount('status')->first()->status;
        // jumlah peminjaman diterima
        $data['jumlahPeminjamanDiterima'] = $this->peminjaman->where([
            'id_user' => $user['id_user'],
            'status' => 'diterima',
        ])->selectCount('status')->first()->status;
        // jumlah pengajuan pengembalian
        $data['jumlahPengajuanPengembalian'] = $this->pengembalian->where([
            'id_user' => $user['id_user'],
            'status' => 'diproses',
        ])->selectCount('status')->first()->status;
        // jumlah pengembalian diterima
        $data['jumlahPengembalianDiterima'] = $this->pengembalian->where([
            'id_user' => $user['id_user'],
            'status' => 'diterima',
        ])->selectCount('status')->first()->status;

        return view('guru/dashboard', $data);
        // dd($data);
    }
}
