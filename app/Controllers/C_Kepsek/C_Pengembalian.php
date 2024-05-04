<?php

namespace App\Controllers\C_Kepsek;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;
use App\Models\pengembalianModel;
use Dompdf\Dompdf;

class C_Pengembalian extends BaseController
{
    function __construct()
    {
        $this->pengembalian = new pengembalianModel();
        $this->setting = new Setting();
    }
    public function pilih_pengembalian()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        // ambil data pengembalian
        $pengembalian = $this->pengembalian->orderBy('id_pengembalian', 'DESC')->findAll();
        $data['pengembalian'] = $pengembalian;
        // jumlah pengembalian
        $data['jumlahPengembalianBarang'] = $this->pengembalian->selectCount('id_pengembalian')->first()->id_pengembalian;

        return view('kepsek/laporan/pengembalian/_laporanPengembalian', $data);
        // dd($data);
    }
    public function cetak_pengembalian()
    {
        // ambil data pengembalian
        $pengembalian = $this->pengembalian->orderBy('id_pengembalian', 'DESC')->findAll();
        $data['pengembalian'] = $pengembalian;
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
        $filename = date('y-m-d-H-i-s') . ' - laporan pengembalian';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('kepsek/laporan/pengembalian/_cetakPengembalian', $data));
        $dompdf->setPaper('A4', 'landscape');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('kepsek/laporan/pengembalian/_cetakPengembalian', $data);
        // dd($data);
    }
}
