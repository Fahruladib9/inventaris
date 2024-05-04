<?php

namespace App\Controllers\C_Kepsek;

use App\Controllers\BaseController;
use App\Models\Barang_KeluarModel;
use App\Models\Barang_MasukModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\Stok_BarangModel;

class C_Kepsek extends BaseController
{
    public function __construct()
    {
        $this->barangMasuk = new Barang_MasukModel();
        $this->barangKeluar = new Barang_KeluarModel();
        $this->peminjaman = new PeminjamanModel();
        $this->pengembalian = new PengembalianModel();
        $this->stokModel = new Stok_BarangModel();
    }
    public function dashboard()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];
        // jumlah barang masuk
        $data['jumlahBarangMasuk'] = $this->barangMasuk->selectCount('id_barangMasuk')->first()->id_barangMasuk;
        // jumlah barang keluar
        $data['jumlahBarangKeluar'] = $this->barangKeluar->selectCount('id_barangKeluar')->first()->id_barangKeluar;
        // jumlah peminjaman
        $data['jumlahPeminjamanBarang'] = $this->peminjaman->selectCount('id_peminjaman')->first()->id_peminjaman;
        // jumlah pengembalian
        $data['jumlahPengembalianBarang'] = $this->pengembalian->selectCount('id_pengembalian')->first()->id_pengembalian;
        // jumlah stok barang
        $data['jumlahStokBarang'] = $this->stokModel->selectCount('id_stokBarang')->first()->id_stokBarang;
        return view('kepsek/dashboard', $data);
        // dd($data);
    }
}
