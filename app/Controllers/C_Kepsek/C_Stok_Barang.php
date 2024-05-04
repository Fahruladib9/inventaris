<?php

namespace App\Controllers\C_Kepsek;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

//memanggil use ke arah model
use App\Models\Stok_BarangModel;
use App\Models\Jenis_BarangModel;
use App\Models\Kondisi_BarangModel;
use App\Models\Satuan_BarangModel;
use Dompdf\Dompdf;

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

        echo view('kepsek/_stokBarang', $data);
        // dd($data);
    }
    public function cetak_stok()
    {
        // memanggil data dari table stok_barang menggunakan findAll di controller
        $query = $this->stokModel->orderBy('id_stokBarang', 'DESC');
        $data['stok_barang'] = $query->findAll();
        // pilih file img yang mau dimasukkan ke dalam halaman yang mau dicetak
        $banyuasin = file_get_contents(
            'assets/img/banyuasin3.png'
        );
        $tutwuri = file_get_contents(
            'assets/img/tut wuri 1.png'
        );

        // Encode image yang dipilih tadi ke base64
        $banyuasin = base64_encode($banyuasin);
        $tutwuri = base64_encode($tutwuri);
        // tampilkan datanya
        $data['banyuasin'] = $banyuasin;
        $data['tutwuri'] = $tutwuri;

        // setting dompdf untuk cetak
        $filename = date('y-m-d-H-i-s') . ' - laporan stok barang';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('kepsek/_cetakStok', $data));
        $dompdf->setPaper('A4', 'potrait');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('kepsek/_cetakStok', $data);
    }
}
