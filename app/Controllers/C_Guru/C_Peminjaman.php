<?php

namespace App\Controllers\C_Guru;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

use App\Models\PeminjamanModel;
use App\Models\Stok_BarangModel;
use stdClass;
use Dompdf\Dompdf;
use Dompdf\Options;


class C_Peminjaman extends BaseController
{
    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->stokModel = new Stok_BarangModel();
        $this->setting = new Setting();
    }

    public function peminjaman()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        // mengambil data dari database
        $data['peminjaman'] = $this->peminjaman->ambilData();
        $data['stok_barang'] = $this->stokModel->findAll();
        // jumlah peminjaman barang
        $data['jumlahPeminjamanBarang'] = $this->peminjaman->where([
            'nama_user' => $user['nama'],
        ])->selectCount('id_peminjaman')->first()->id_peminjaman;

        return view('guru/peminjaman/_peminjaman', $data);
        // dd($data);
    }
    public function tambah_view($id = null)
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];
        $data['newKodePeminjaman'] = $this->kode_peminjaman()->newKodePeminjaman;

        $stokBarang = $this->stokModel->where('id_stokBarang', $id)->first();
        $data['stok_tambah'] = $stokBarang;

        // dd($data);
        return view('guru/peminjaman/tambah', $data);
    }

    public function kode_peminjaman()
    {
        // ambil kode peminjaman terakhir
        $kodeTerakhir = $this->peminjaman->ambilKodePeminjaman();
        $data = new stdClass;
        $newKodePeminjaman = 'PBR001';
        if ($kodeTerakhir) {
            $lastKode = $kodeTerakhir->kode_peminjaman;
            $newKodePeminjaman = 'PBR' . str_pad((intval(substr($lastKode, 3)) + 1), 3, '0', STR_PAD_LEFT);
        }
        $data->newKodePeminjaman = $newKodePeminjaman;
        return $data;
    }
    public function tambah()
    {
        $user = session('user');
        // allert sukses ditambahkan
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Ditambahkan', 'success');
        $kodePeminjaman = $this->request->getPost('kode_peminjaman');
        $namaBarang = $this->request->getPost('nama_barang');
        $jumlah = $this->request->getPost('jumlah');
        $keterangan = $this->request->getPost('keterangan');
        $tanggalPeminjaman = $this->request->getPost('tanggal_peminjaman');
        $tanggalPengembalian = $this->request->getPost('tanggal_pengembalian');

        $stokBarang = $this->stokModel->where('nama_barang', $namaBarang)->first();
        $newJumlah = $stokBarang->jumlah - $jumlah;
        $tanggalSekarang = date('Y-m-d');
        if ($stokBarang) {
            if ($newJumlah < 0) {
                $this->setting->allertSukses('Error', 'Jumlah Peminjaman Tidak Boleh Melebihi Jumlah Stok', 'error');
            } else if ($tanggalPeminjaman < $tanggalSekarang) {
                $this->setting->allertSukses('Error', 'Tanggal peminjaman tidak boleh kurang dari tanggal sekarang', 'error');
            } else if ($tanggalPengembalian < $tanggalPeminjaman) {
                $this->setting->allertSukses('Error', 'Tanggal pengembalian tidak boleh kurang dari tanggal peminjaman', 'error');
            } else if ($newJumlah > 0) {
                // insert data di table _peminjaman
                $this->peminjaman->insert([
                    'id_user' => $user['id_user'],
                    'id_stokBarang' => $stokBarang->id_stokBarang,
                    'nama_user' => $user['nama'],
                    'kode_peminjaman' => $kodePeminjaman,
                    'nama_barang' => $namaBarang,
                    'jumlah' => $jumlah,
                    'keterangan' => $keterangan,
                    'tanggal_peminjaman' => $tanggalPeminjaman,
                    'tanggal_pengembalian' => $tanggalPengembalian,
                    'status' => 'diproses',
                ]);
            }
            return redirect()->back();
        }
    }
    public function delete($id = null)
    {
        // alert sukses dihapus
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Dihapus', 'success');
        $this->peminjaman->delete($id);
        return redirect()->to('guru/peminjaman');
    }
    public function cetak_peminjaman($id = null)
    {
        // ambil data yang mau di cetak
        $peminjaman = $this->peminjaman->where('id_peminjaman', $id)->first();
        $data['peminjaman'] = $peminjaman;

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
        $filename = date('y-m-d-H-i-s') . ' - bukti peminjaman';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('guru/peminjaman/_cetakBukti', $data));
        $dompdf->setPaper('A4', 'potrait');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('guru/peminjaman/_cetakBukti', $data);
    }
}
