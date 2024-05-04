<?php

namespace App\Controllers\C_Data_Barang;

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
use stdClass;

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

        // pakai query builder tanpa model
        $tbJenis = $this->db->table('_jenisbarang')->get();
        $data['jenis_barang'] = $tbJenis->getResult();
        // tampil data kondisi barang pakai model
        $tbKondisi = $this->kondisiModel;
        $data['kondisi_barang'] = $tbKondisi->findAll();
        // tampil data satuan barang pakai model
        $tbSatuan = $this->satuanModel;
        $data['satuan_barang'] = $tbSatuan->findAll();
        // membuat kode barang otomatis dari function kode_barang
        $data['newKodeBarang'] = $this->kode_barang()->newKodeBarang;
        // jumlah stok barang
        $data['jumlahStokBarang'] = $this->stokModel->selectCount('id_stokBarang')->first()->id_stokBarang;

        echo view('data_barang/stok_barang/_stokBarang', $data);
        // dd($data);
    }
    public function kode_barang()
    {
        // ambil function kode barang terakhir dari model
        $kodeBarangTerakhir = $this->stokModel->kodeBarangTerakhir();
        $data = new stdClass();
        $newKodeBarang = 'BRG001';
        if ($kodeBarangTerakhir) {
            $lastKode = $kodeBarangTerakhir->kode_barang;
            $newKodeBarang = 'BRG' . str_pad((intval(substr($lastKode, 3)) + 1), 3, '0', STR_PAD_LEFT);
        }
        $data->newKodeBarang = $newKodeBarang;

        return $data;
    }
    public function tambah()
    {
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Tambahkan', 'success');
        $data = $this->request->getPost();
        $namaBarang = $data['nama_barang'];
        $namaSama = $this->stokModel->CekNamaSama($namaBarang);

        if ($namaSama) {
            $this->setting->allertSukses('Error', 'Nama Barang Sudah Tersedia', 'error');
            return redirect()->to('stok_barang');
        } else {
            $this->stokModel->insert($data);
            return redirect()->to('stok_barang');
        }
    }
    public function edit($id = null)
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $stok_barang = $this->stokModel->where('id_stokBarang', $id)->first();
        $jenis_barang = $this->jenisModel;
        $kondisi_barang = $this->kondisiModel;
        $satuan_barang = $this->satuanModel;
        $data['jenis_barang'] = $jenis_barang->find();
        $data['kondisi_barang'] = $kondisi_barang->find();
        $data['satuan_barang'] = $satuan_barang->find();
        // dd($data);
        if ($stok_barang) {
            $data['stok_barang'] = $stok_barang;
            return view('data_barang/stok_barang/edit', $data);
            // dd($data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function update($id = null)
    {
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Diupdate', 'success');
        $data = $this->request->getPost();
        $this->stokModel->update($id, $data);
        return redirect()->to('stok_barang');
    }
    public function delete($id = null)
    {
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Dihapus', 'success');
        $this->stokModel->delete($id);
        return redirect()->to('stok_barang');
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
        $dompdf->loadHtml(view('data_barang/stok_barang/_cetakStok', $data));
        $dompdf->setPaper('A4', 'potrait');
        // render ke pdf
        $dompdf->render();
        // output output ke generate menjadi pdf
        $dompdf->stream($filename);

        // return view('kepsek/_cetakStok', $data);
    }
}
