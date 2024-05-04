<?php

namespace App\Controllers\C_Data_Barang;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

//memanggil use ke arah model
use App\Models\Jenis_BarangModel;

use function PHPUnit\Framework\throwException;

class C_Jenis_Barang extends BaseController
{
    function __construct()
    {
        $this->jenis = new Jenis_BarangModel();
        $this->setting = new Setting();
    }
    public function jenis_barang()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $data['jenis_barang'] = $this->jenis->tampilBarang();
        return view('data_barang/jenis_barang/_jenisBarang', $data);
    }
    public function tambah()
    {
        // menampilkan pesan ketika berhasil di tambahkan
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Tambahkan', 'success');
        $data = $this->request->getPost();
        $this->jenis->insert($data);
        return redirect()->to('jenis_barang');
    }
    public function edit($id = null)
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $jenis = $this->jenis->where('id_jenisBarang', $id);
        // dd($data);
        if (is_object($jenis)) {
            $data['jenis_barang'] = $jenis->first();
            return view('data_barang/jenis_barang/edit', $data);
            // dd($data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function update($id = null)
    {
        // menampilkan pesan ketika berhasil di update
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Update', 'success');
        $data = $this->request->getPost();
        $this->jenis->update($id, $data);
        return redirect()->to('jenis_barang');
    }
    public function delete($id = null)
    {
        // menampilkan pesan ketika berhasil di update
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Hapus', 'success');
        // $data = $this->request->getPost();
        $this->jenis->delete($id);
        return redirect()->to('jenis_barang');
    }
}
