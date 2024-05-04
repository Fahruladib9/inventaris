<?php

namespace App\Controllers\C_Data_Barang;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

//memanggil use ke arah model
use App\Models\Kondisi_BarangModel;


class C_Kondisi_Barang extends BaseController
{
    function __construct()
    {
        $this->kondisi = new Kondisi_BarangModel();
        $this->setting = new Setting();
    }
    public function kondisi_barang()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $data['kondisi_barang'] = $this->kondisi->tampilBarang();
        return view('data_barang/kondisi/_kondisi', $data);
    }
    public function tambah()
    {
        // menampilkan pesan ketika berhasil di tambahkan
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Tambahkan', 'success');
        $data = $this->request->getPost();
        $this->kondisi->insert($data);
        return redirect()->to('kondisi_barang');
    }
    public function edit($id = null)
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $kondisi = $this->kondisi->where('id_kondisi', $id);
        // dd($data);
        if (is_object($kondisi)) {
            $data['kondisi_barang'] = $kondisi->first();
            return view('data_barang/kondisi/edit', $data);
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
        $this->kondisi->update($id, $data);
        return redirect()->to('kondisi_barang');
    }
    public function delete($id = null)
    {
        // menampilkan pesan ketika berhasil di update
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Hapus', 'success');
        // $data = $this->request->getPost();
        $this->kondisi->delete($id);
        return redirect()->to('kondisi_barang');
    }
}
