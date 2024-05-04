<?php

namespace App\Controllers;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\Stok_BarangModel;
use stdClass;
use Dompdf\Dompdf;
use Dompdf\Options;


class C_Pengembalian extends BaseController
{
    public function __construct()
    {
        $this->pengembalian = new PengembalianModel();
        $this->peminjaman = new PeminjamanModel();
        $this->stokModel = new Stok_BarangModel();
        $this->setting = new Setting();
    }

    public function pengembalian()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        // mengambil data dari database
        $data['pengembalian'] = $this->pengembalian->orderBy('id_pengembalian', 'DESC')->findAll();
        // jumlah pengembalian barang
        $data['jumlahPengembalianBarang'] = $this->pengembalian->selectCount('id_pengembalian')->first()->id_pengembalian;

        return view('pengembalian/_pengembalian', $data);
        // dd($data);
    }

    public function kode_pengembalian()
    {
        // ambil kode pengembalian terakhir
        $kodeTerakhir = $this->pengembalian->ambilKodePengembalian();
        $data = new stdClass;
        $newKodePengembalian = 'KBR001';
        if ($kodeTerakhir) {
            $lastKode = $kodeTerakhir->kode_peminjaman;
            $newKodePengembalian = 'KBR' . str_pad((intval(substr($lastKode, 3)) + 1), 3, '0', STR_PAD_LEFT);
        }
        $data->newKodePengembalian = $newKodePengembalian;
        return $data;
    }
    public function delete($id = null)
    {
        // alert sukses dihapus
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Dihapus', 'success');
        $this->peminjaman->delete($id);
        return redirect()->to('peminjaman');
    }

    public function kembalikan($id = null)
    {
        // alert sukses kembali
        $this->setting->allertSukses('Sukses', 'Pengajuan Pengembalian Berhasil', 'success');
        $user = session('user');
        $kembalikan = $this->peminjaman->where('id_peminjaman', $id)->first();
        $kodePengembalian = $this->kode_pengembalian()->newKodePengembalian;
        $this->pengembalian->insert([
            'id_user' => $user['id_user'],
            'nama_user' => $user['nama'],
            'kode_pengembalian' => $kodePengembalian,
            'nama_barang' => $kembalikan->nama_barang,
            'jumlah' => $kembalikan->jumlah,
            'status' => 'diproses',
        ]);
        return redirect()->to('peminjaman');
    }

    public function terima($id = null)
    {
        $this->setting->allertSukses('Sukses', 'Pengembalian Di Terima', 'success');
        $pengembalian = $this->pengembalian->where('id_pengembalian', $id)->first();
        $peminjaman = $this->peminjaman->where('id_peminjaman', $pengembalian->id_peminjaman);
        $stokBarang = $this->stokModel->where('id_stokBarang', $pengembalian->id_stokBarang)->first();
        $updateJumlah = $stokBarang->jumlah + $pengembalian->jumlah;
        if ($pengembalian->jumlah > $stokBarang->jumlah_dipinjam) {
            $this->setting->allertSukses('Error', 'Jumlah Pengembalian Tidak Boleh Melebihi Jumlah Dipinjam', 'error');
        } else {
            // update status pengembalian
            $this->pengembalian->update($id, [
                'status' => 'diterima',
            ]);
            // update status peminjaman
            $this->peminjaman->update($peminjaman->id_peminjaman, [
                'status' => 'dikembalikan',
            ]);
            // update data di stok barang
            $this->stokModel->update($stokBarang->id_stokBarang, [
                'jumlah' => $updateJumlah,
                'jumlah_dipinjam' => $stokBarang->jumlah_dipinjam - $pengembalian->jumlah,
            ]);
        }
        return redirect()->to('pengembalian');
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
        $dompdf->loadHtml(view('pengembalian/_cetakPengembalian', $data));
        $dompdf->setPaper('A4', 'landscape');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('pengembalian/_cetakPengembalian', $data);
        // dd($data);
    }
}
