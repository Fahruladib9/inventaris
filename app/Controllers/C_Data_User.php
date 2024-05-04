<?php

namespace App\Controllers;

// namespace App\Models;

//mengarahkan controller ke App\Controllers\BaseController
use App\Controllers\BaseController;
use App\Controllers\Setting;

//memanggil use ke arah model
use App\Models\Data_UserModel;

class C_Data_User extends BaseController
{
    function __construct()
    {
        $this->user = new Data_UserModel();
        $this->setting = new Setting();
    }
    public function data_user()
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $data['data_user'] = $this->user->tampilData();
        return view('data_user/_dataUser', $data);
    }
    public function tambah()
    {
        // menampilkan pesan ketika berhasil di tambahkan
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Tambahkan', 'success');
        $data = $this->request->getPost();
        $this->user->insert($data);
        return redirect()->to('data_user');
    }
    public function edit($id = null)
    {
        // mengambil session yang sedang login saat ini
        $user = session('user');
        $data['username'] = $user['username'];
        $data['nama'] = $user['nama'];
        $data['akses'] = $user['akses'];

        $user = $this->user->find($id);

        if ($user) {
            $data['data_user'] = $user;
            return view('data_user/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Maaf Halaman Tidak Ditemukan");
        }
    }

    public function update($id = null)
    {
        // menampilkan pesan ketika berhasil di update
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Update', 'success');
        $data = $this->request->getPost();
        $this->user->update($id, $data);
        return redirect()->to('data_user');
    }
    public function delete($id = null)
    {
        // menampilkan pesan ketika berhasil di update
        // mengambil dari class setting function allertSukses di controller
        $this->setting->allertSukses('Sukses', 'Data Berhasil Di Hapus', 'success');
        // $data = $this->request->getPost();
        $this->user->delete($id);
        return redirect()->to('data_user');
    }
}
