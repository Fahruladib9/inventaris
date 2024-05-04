<?php

namespace App\Controllers;

use App\Models\Barang_KeluarModel;
use App\Models\Barang_MasukModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\Stok_BarangModel;

class C_Home extends BaseController
{
    public function __construct()
    {
        $this->barangMasuk = new Barang_MasukModel();
        $this->barangKeluar = new Barang_KeluarModel();
        $this->peminjaman = new PeminjamanModel();
        $this->pengembalian = new PengembalianModel();
        $this->stokModel = new Stok_BarangModel();
    }

    public function index()
    {
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];
        // jumlah barang masuk
        $data['jumlahBarangMasuk'] = $this->barangMasuk->selectCount('id_barangMasuk')->first()->id_barangMasuk;
        $data['jumlahBarangKeluar'] = $this->barangKeluar->selectCount('id_barangKeluar')->first()->id_barangKeluar;
        $data['jumlahStokBarang'] = $this->stokModel->selectCount('id_stokBarang')->first()->id_stokBarang;
        $data['jumlahPengajuanPeminjaman'] = $this->peminjaman->where([
            'status' => 'diproses'
        ])->selectCount('status')->first()->status;
        $data['jumlahPengajuanPengembalian'] = $this->pengembalian->where([
            'status' => 'diproses'
        ])->selectCount('status')->first()->status;
        return view('home', $data);
        // dd($data);
    }
}
