<?php

namespace App\Controllers\C_Kepsek;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;
use App\Models\PeminjamanModel;
use Dompdf\Dompdf;

class C_Peminjaman extends BaseController
{
    function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->setting = new Setting();
    }
    public function pilih_peminjaman()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        // ambil data peminjaman
        $peminjaman = $this->peminjaman->findAll();
        $data['peminjaman'] = $peminjaman;
        // jumlah peminjaman
        $data['jumlahPeminjamanBarang'] = $this->peminjaman->selectCount('id_peminjaman')->first()->id_peminjaman;

        echo view('kepsek/laporan/peminjaman/_laporanPeminjaman', $data);
        // dd($data);
    }
    public function cetak_peminjaman()
    {
        // ambil data peminjaman
        $peminjaman = $this->peminjaman->findAll();
        $data['peminjaman'] = $peminjaman;
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
        $filename = date('y-m-d-H-i-s') . ' - laporan peminjaman';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('kepsek/laporan/peminjaman/_cetakPeminjaman', $data));
        $dompdf->setPaper('A4', 'landscape');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('kepsek/laporan/peminjaman/_cetakPeminjaman', $data);
        // dd($data);
    }
}
