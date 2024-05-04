<?php

namespace App\Controllers\C_Data_Barang;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

//memanggil use ke arah model
use App\Models\Satuan_BarangModel;


class C_Satuan_Barang extends BaseController
{
    function __construct()
    {
        $this->satuan = new satuan_BarangModel();
        $this->setting = new Setting();
    }
    public function satuan_barang()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $data['satuan_barang'] = $this->satuan->tampilBarang();
        return view('data_barang/satuan/_satuan', $data);
    }
    public function tambah()
    {
        // menampilkan pesan ketika berhasil di tambahkan
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Tambahkan', 'success');
        $data = $this->request->getPost();
        $this->satuan->insert($data);
        return redirect()->to('satuan_barang');
    }
    public function edit($id = null)
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $satuan = $this->satuan->where('id_satuan', $id);
        // dd($data);
        if (is_object($satuan)) {
            $data['satuan_barang'] = $satuan->first();
            return view('data_barang/satuan/edit', $data);
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
        $this->satuan->update($id, $data);
        return redirect()->to('satuan_barang');
    }
    public function delete($id = null)
    {
        // menampilkan pesan ketika berhasil di update
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Hapus', 'success');
        // $data = $this->request->getPost();
        $this->satuan->delete($id);
        return redirect()->to('satuan_barang');
    }
}
