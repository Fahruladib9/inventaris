<?php

namespace App\Controllers\C_Data_Barang;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

use App\Models\Stok_BarangModel;
use App\Models\Barang_KeluarModel;
use Dompdf\Dompdf;
use stdClass;

class C_Barang_Keluar extends BaseController
{

    public function __construct()
    {
        $this->setting = new Setting();
        $this->stokModel = new Stok_BarangModel();
        $this->barangKeluar = new Barang_KeluarModel();
    }

    public function barang_keluar()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        // tampil stok barang untuk nama barang
        $stok_barang = $this->stokModel->findAll();
        $data['stok_barang'] = $stok_barang;

        // tampil barang keluar
        $data['barang_keluar'] = $this->barangKeluar->findAll();
        // jumlah barang keluar
        $data['jumlahBarangKeluar'] = $this->barangKeluar->selectCount('id_barangKeluar')->first()->id_barangKeluar;

        return view('barang_keluar/_barangKeluar', $data);
        // dd($data);
    }

    public function tambah_view($id = null)
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $stokBarang = $this->stokModel->where('id_stokBarang', $id)->first();

        $data['stok_tambah'] = $stokBarang;
        $data['newKodeTransaksi'] = $this->kode_transaksi()->newKodeTransaksi;

        return view('barang_keluar/tambah', $data);
        // dd($data);
    }

    public function kode_transaksi()
    {
        // ambil function kode barang terakhir dari model
        $kodeTransaksiTerakhir = $this->barangKeluar->kodeTransaksiTerakhir();
        $data = new stdClass();
        $newKodeTransaksi = 'TRK001';
        if ($kodeTransaksiTerakhir) {
            $lastKode = $kodeTransaksiTerakhir->kode_transaksi;
            $newKodeTransaksi = 'TRK' . str_pad((intval(substr($lastKode, 3)) + 1), 3, '0', STR_PAD_LEFT);
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
        $jumlah = $this->request->getPost('jumlah');
        $keterangan = $this->request->getPost('keterangan');
        $tanggal = $this->request->getPost('tanggal');

        // cek data di stok_barang
        $stokBarang = $this->stokModel->where('nama_barang', $nama_barang)->first();

        if ($stokBarang) {
            $newJumlah = $stokBarang->jumlah - $jumlah;
            if ($newJumlah < 0) {
                $this->setting->allertSukses('Error', 'Jumlah Pengeluaran Tidak Boleh Melebihi Jumlah Stok', 'error');
            } else {
                // update data jumlah di stok barang
                $this->stokModel->update($stokBarang->id_stokBarang, [
                    'jumlah' => $newJumlah
                ]);

                // tambahkan data barang masuk
                $this->barangKeluar->insert([
                    'kode_transaksi' => $kode_transaksi,
                    'nama_barang' => $nama_barang,
                    'jumlah' => $jumlah,
                    'keterangan' => $keterangan,
                    'tanggal' => $tanggal
                ]);
            }
            return redirect()->to('barang_keluar');
        }
    }

    public function delete($id = null)
    {
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Dihapus', 'success');
        $this->barangKeluar->delete($id);
        return redirect()->to('barang_keluar');
    }

    public function pilih_barang_keluar()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        echo view('laporan/barang_Keluar/_laporanBarangKeluar', $data);
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
        $dompdf->loadHtml(view('laporan/barang_keluar/_cetakBarangKeluar', $data));
        $dompdf->setPaper('A4', 'potrait');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('laporan/barang_Keluar/_cetakBarangKeluar', $data);
        // dd($data);
    }
}
