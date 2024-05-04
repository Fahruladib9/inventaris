<?php

namespace App\Controllers\C_Data_Barang;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

use App\Models\Data_SuplierModel;
use App\Models\Stok_BarangModel;
use App\Models\Barang_MasukModel;
use Dompdf\Dompdf;
use stdClass;

class C_Barang_Masuk extends BaseController
{
    public function __construct()
    {
        $this->barangMasuk = new Barang_MasukModel();
        $this->stokModel = new Stok_BarangModel();
        $this->suplierModel = new Data_SuplierModel();
        $this->setting = new Setting();
    }

    public function barang_masuk()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $barangMasuk = $this->barangMasuk->orderBy('id_barangMasuk', 'DESC')->findAll();
        $data['barang_masuk'] = $barangMasuk;
        // ambil data nama_barang dari table stok_barang
        $namaBarang = $this->stokModel->select('id_stokBarang, nama_barang');
        $data['nama_barang'] = $namaBarang->findAll();
        // ambil data suplier dari table suplier
        $suplier = $this->suplierModel->findAll();
        $data['suplier'] = $suplier;
        // ambil kode transaksi
        $data['newKodeTransaksi'] = $this->kode_transaksi()->newKodeTransaksi;
        $jumlahBarangMasuk = $this->barangMasuk->selectCount('jumlah')->first();
        $data['jumlahbarangmasuk'] = $jumlahBarangMasuk->jumlah;

        echo view('barang_masuk/_barangMasuk', $data);
        // dd($data);
    }

    public function kode_transaksi()
    {
        // ambil function kode barang terakhir dari model
        $kodeTransaksiTerakhir = $this->barangMasuk->kodeTransaksiTerakhir();
        $data = new stdClass();
        $newKodeTransaksi = 'TRM001';
        if ($kodeTransaksiTerakhir) {
            $lastKode = $kodeTransaksiTerakhir->kode_transaksi;
            $newKodeTransaksi = 'TRM' . str_pad((intval(substr($lastKode, 3)) + 1), 3, '0', STR_PAD_LEFT);
        }
        $data->newKodeTransaksi = $newKodeTransaksi;

        return $data;
    }

    public function tambah()
    {
        $this->setting->allertSukses('Sukses', 'Data Berhasil Ditambahkan', 'success');
        // tampung data yang diinput ke variable
        $kode_transaksi = $this->request->getPost('kode_transaksi');
        $nama_barang = $this->request->getPost('nama_barang');
        $suplier = $this->request->getPost('suplier');
        $jumlah = $this->request->getPost('jumlah');
        $tanggal = $this->request->getPost('tanggal');
        // tambahkan data barang masuk
        $this->barangMasuk->insert([
            'kode_transaksi' => $kode_transaksi,
            'nama_barang' => $nama_barang,
            'suplier' => $suplier,
            'jumlah' => $jumlah,
            'tanggal' => $tanggal
        ]);

        // cek data di stok_barang
        $stokBarang = $this->stokModel->where('nama_barang', $nama_barang)->first();

        if ($stokBarang) {
            $newJumlah = $stokBarang->jumlah + $jumlah;
            $this->stokModel->update($stokBarang->id_stokBarang, [
                'jumlah' => $newJumlah
            ]);
        }
        return redirect()->to('barang_masuk');
    }

    public function delete($id = null)
    {
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Dihapus', 'success');
        $this->barangMasuk->delete($id);
        return redirect()->to('barang_masuk');
    }

    public function pilih_barang_masuk()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        echo view('laporan/barang_masuk/_laporanBarangMasuk', $data);
        // dd($data);
    }
    public function cetak_barang_masuk()
    {
        $tanggalAwal = $this->request->getPost('tanggal_awal');
        $tanggalAkhir = $this->request->getPost('tanggal_akhir');
        // ambil data berdasarkan rentang tanggal
        $rentangTanggal = $this->barangMasuk->where('tanggal >=', $tanggalAwal)->where('tanggal <=', $tanggalAkhir)->findAll();
        $data['barang_masuk'] = $rentangTanggal;
        $data['tanggal_awal'] = $tanggalAwal;
        $data['tanggal_akhir'] = $tanggalAkhir;
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
        $filename = date('y-m-d-H-i-s') . ' - laporan barang masuk';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('laporan/barang_masuk/_cetakBarangMasuk', $data));
        $dompdf->setPaper('A4', 'potrait');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('laporan/barang_masuk/_cetakBarangMasuk', $data);
        // dd($data);
    }
}
