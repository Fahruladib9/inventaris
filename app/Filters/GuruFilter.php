<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuruFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = session('user');
        if ($user && $user['akses'] == 'Guru') {
            // Jika pengguna adalah Guru, maka batasi akses dan tampilkan pesan error
            // $response = service('response');
            // $response->setStatusCode(403);
            // $response->setBody('<h1 style=
            // "color: red; 
            // font-size: 24px; 
            // text-align: center;
            // ">
            //     Oops!
            // </h1>
            //     <p style=
            //     "text-align: center;
            //     ">
            //         Maaf, akses Anda sebagai Guru ditolak untuk mengakses halaman ini.
            //     </p>');

            // return $response;
            return redirect()->to('/guru/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
