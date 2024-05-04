<?php

namespace App\Controllers\C_Kepsek;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;
use App\Models\Barang_KeluarModel;
use Dompdf\Dompdf;

class C_Barang_Keluar extends BaseController
{
    function __construct()
    {
        $this->barangKeluar = new Barang_KeluarModel();
        $this->setting = new Setting();
    }
    public function pilih_barang_keluar()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        echo view('kepsek/laporan/barang_Keluar/_laporanBarangKeluar', $data);
        // dd($data);
    }
    public function cetak_barang_keluar()
    {
        $tanggalAwal = $this->request->getPost('tanggal_awal');
        $tanggalAkhir = $this->request->getPost('tanggal_akhir');
        // ambil data berdasarkan rentang tanggal
        $rentangTanggal = $this->barangKeluar->where('tanggal >=', $tanggalAwal)->where('tanggal <=', $tanggalAkhir)->findAll();
        $data['barang_keluar'] = $rentangTanggal;
        $data['tanggal_awal'] = $tanggalAwal;
        $data['tanggal_akhir'] = $tanggalAkhir;
        // pilih file img yang mau diKeluarkan ke dalam halaman yang mau dicetak
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
        $filename = date('y-m-d-H-i-s') . ' - laporan barang Keluar';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('kepsek/laporan/barang_keluar/_cetakBarangKeluar', $data));
        $dompdf->setPaper('A4', 'potrait');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('kepsek/laporan/barang_Keluar/_cetakBarangKeluar', $data);
        // dd($data);
    }
}
