<?php

namespace App\Controllers;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

use App\Models\PeminjamanModel;
use App\Models\Stok_BarangModel;
use Dompdf\Dompdf;

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
        $data['peminjaman'] = $this->peminjaman->orderBy('id_peminjaman', 'DESC')->findAll();
        // jumlah peminjaman barang
        $data['jumlahPeminjamanBarang'] = $this->peminjaman->selectCount('id_peminjaman')->first()->id_peminjaman;

        return view('peminjaman/_peminjaman', $data);
        // dd($data);
    }
    public function delete($id = null)
    {
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Dihapus', 'success');
        $this->peminjaman->delete($id);
        return redirect()->to('peminjaman');
    }
    public function terima($id = null)
    {
        $this->setting->allertSukses('Sukses', 'Peminjaman Di Terima', 'success');
        $peminjaman = $this->peminjaman->where('id_peminjaman', $id)->first();
        $stokBarang = $this->stokModel->where('id_stokBarang', $peminjaman->id_stokBarang)->first();
        $updateJumlah = $stokBarang->jumlah - $peminjaman->jumlah;
        if ($updateJumlah < 0) {
            $this->setting->allertSukses('Error', 'Jumlah Peminjaman Tidak Boleh Melebihi Jumlah Stok', 'error');
        } else {
            // update status peminjaman
            $this->peminjaman->update($id, [
                'status' => 'diterima',
            ]);
            // update data di stok barang
            $this->stokModel->update($stokBarang->id_stokBarang, [
                'jumlah' => $updateJumlah,
                'jumlah_dipinjam' => $stokBarang->jumlah_dipinjam + $peminjaman->jumlah,
            ]);
        }
        return redirect()->to('peminjaman');
        // dd($data);
    }
    public function tolak($id = null)
    {
        $this->setting->allertSukses('Sukses', 'Peminjaman Di Tolak', 'success');
        $this->peminjaman->update($id, [
            'status' => 'ditolak',
        ]);
        return redirect()->to('peminjaman');
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
        $dompdf->loadHtml(view('peminjaman/_cetakPeminjaman', $data));
        $dompdf->setPaper('A4', 'landscape');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('peminjaman/_cetakPeminjaman', $data);
        // dd($data);
    }
}
