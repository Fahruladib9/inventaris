<?php

namespace App\Controllers;

class Setting extends BaseController
{
    public function allertSukses($sukses, $pesan, $icon)
    {
        // konfigurasi untuk menampilkan allert
        $session = session();
        $session->setFlashdata('success', $sukses);
        $session->setFlashdata('pesan', $pesan);
        $session->setFlashdata('icon', $icon);
    }
}
