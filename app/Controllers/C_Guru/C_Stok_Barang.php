<?php

namespace App\Controllers\C_Guru;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

//memanggil use ke arah model
use App\Models\Stok_BarangModel;
use App\Models\Jenis_BarangModel;
use App\Models\Kondisi_BarangModel;
use App\Models\Satuan_BarangModel;

class C_Stok_Barang extends BaseController
{
    function __construct()
    {
        $this->stokModel = new Stok_BarangModel();
        $this->jenisModel = new Jenis_BarangModel();
        $this->kondisiModel = new Kondisi_BarangModel();
        $this->satuanModel = new Satuan_BarangModel();
        $this->setting = new Setting();
    }
    public function stok_barang()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        // cara pertama manggil di controller
        // memanggil data dari table stok_barang menggunakan findAll di controller
        $query = $this->stokModel->orderBy('id_stokBarang', 'DESC');
        $data['stok_barang'] = $query->findAll();

        //cara ketiga pakai query builder tanpa model
        $tbJenis = $this->db->table('_jenisbarang')->get();
        $data['jenis_barang'] = $tbJenis->getResult();
        // tampil data kondisi barang pakai model
        $tbKondisi = $this->kondisiModel;
        $data['kondisi_barang'] = $tbKondisi->findAll();
        // tampil data satuan barang pakai model
        $tbSatuan = $this->satuanModel;
        $data['satuan_barang'] = $tbSatuan->findAll();
        // jumlah stok barang
        $data['jumlahStokBarang'] = $this->stokModel->selectCount('id_stokBarang')->first()->id_stokBarang;

        echo view('guru/_stokBarang', $data);
        // dd($data);
    }
}
