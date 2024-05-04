<?php

namespace App\Controllers;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

//memanggil use ke arah model
use App\Models\Data_SuplierModel;

class C_Data_Suplier extends BaseController
{
    function __construct()
    {
        $this->suplier = new Data_SuplierModel();
        $this->setting = new Setting();
    }
    public function data_suplier()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $data['data_suplier'] = $this->suplier->tampilData();
        return view('data_suplier/_dataSuplier', $data);
    }
    public function tambah()
    {
        // menampilkan pesan ketika berhasil di tambahkan
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Tambahkan', 'success');
        $data = $this->request->getPost();
        $this->suplier->insert($data);
        return redirect()->to('data_suplier');
    }
    public function edit($id = null)
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $suplier = $this->suplier->where('id_dataSuplier', $id);
        // dd($data);
        if (is_object($suplier)) {
            $data['data_suplier'] = $suplier->first();
            return view('data_suplier/edit', $data);
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
        $this->suplier->update($id, $data);
        return redirect()->to('data_suplier');
    }
    public function delete($id = null)
    {
        // menampilkan pesan ketika berhasil di update
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Hapus', 'success');
        // $data = $this->request->getPost();
        $this->suplier->delete($id);
        return redirect()->to('data_suplier');
    }
}
