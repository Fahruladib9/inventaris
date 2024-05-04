<?php

namespace App\Controllers\C_Guru;

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
        $data['pengembalian'] = $this->pengembalian->ambilData();
        // jumlah pengembalian barang
        $data['jumlahPengembalianBarang'] = $this->pengembalian->where([
            'nama_user' => $user['nama'],
        ])->selectCount('id_pengembalian')->first()->id_pengembalian;

        return view('guru/pengembalian/_pengembalian', $data);
        // dd($data);
    }

    public function kode_pengembalian()
    {
        // ambil kode pengembalian terakhir
        $kodeTerakhir = $this->pengembalian->ambilKodePengembalian();
        $data = new stdClass;
        $newKodePengembalian = 'KBR001';
        if ($kodeTerakhir) {
            $lastKode = $kodeTerakhir->kode_pengembalian;
            $newKodePengembalian = 'KBR' . str_pad((intval(substr($lastKode, 3)) + 1), 3, '0', STR_PAD_LEFT);
        }
        $data->newKodePengembalian = $newKodePengembalian;
        return $data;
    }
    public function delete($id = null)
    {
        // alert sukses dihapus
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Dihapus', 'success');
        $this->pengembalian->delete($id);
        return redirect()->to('guru/pengembalian');
    }
    public function cetak_pengembalian($id = null)
    {
        // ambil data yang mau di cetak
        $pengembalian = $this->pengembalian->where('id_pengembalian', $id)->first();
        $data['pengembalian'] = $pengembalian;

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
        $filename = date('y-m-d-H-i-s') . ' - bukti pengembalian';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('guru/pengembalian/_cetakBukti', $data));
        $dompdf->setPaper('A4', 'potrait');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('guru/pengembalian/_cetakBukti', $data);
    }
    public function kembalikan($id = null)
    {
        // mengembalikan barang
        // alert sukses kembalikan
        $this->setting->allertSukses('Sukses', 'Pengajuan Pengembalian Berhasil', 'success');
        $user = session('user');
        $kembalikan = $this->peminjaman->where('id_peminjaman', $id)->first();
        $kodePengembalian = $this->kode_pengembalian()->newKodePengembalian;
        $this->pengembalian->insert([
            'id_peminjaman' => $kembalikan->id_peminjaman,
            'id_stokBarang' => $kembalikan->id_stokBarang,
            'id_user' => $user['id_user'],
            'nama_user' => $user['nama'],
            'kode_pengembalian' => $kodePengembalian,
            'nama_barang' => $kembalikan->nama_barang,
            'jumlah' => $kembalikan->jumlah,
            'status' => 'diproses',
        ]);
        $this->peminjaman->update($kembalikan->id_peminjaman, [
            'status' => 'proses pengembalian',
        ]);
        return redirect()->to('guru/peminjaman');
    }
}
