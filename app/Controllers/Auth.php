<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Data_UserModel;
use App\Controllers\Setting;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->userModel = new Data_UserModel();
        $this->setting = new Setting();
    }

    public function login()
    {
        return view('login');
    }

    public function proses_login()
    {
        $this->setting->allertSukses('Sukses', 'Login Berhasil', 'success');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $userModel = $this->userModel;

        // cek user terdaftar di database
        $user = $userModel->ambil_data_username($username);

        // kalau user terdaftar
        if ($user && $user->password == $password) {
            $userData = [
                'id_user' => $user->id_user,
                'username' => $user->username,
                'password' => $user->password,
                'nama' => $user->nama,
                'akses' => $user->akses
            ];
            // simpan ke dalam session user
            session()->set('user', $userData);

            // redirect ke dashboard berdasarkan hak akses
            if ($user->akses == 'Admin') {
                return redirect()->to('/');
            } else if ($user->akses == 'Guru') {
                return redirect()->to('guru/dashboard');
            } else if ($user->akses == 'Kepsek') {
                return redirect()->to('kepsek/dashboard');
            }
        } else {
            // jika login gagal tampil pesan kesalahan
            session()->setFlashdata('error', 'Username atau password salah.');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        // Hapus data pengguna dari session saat logout
        session()->remove('user');
        return redirect()->to('login');
    }
}
