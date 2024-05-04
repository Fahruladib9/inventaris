<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Auth
$routes->get('/login', 'Auth::login');
$routes->post('/proses_login', 'Auth::proses_login');
$routes->get('/logout', 'Auth::logout');

// guru
$routes->get('/guru/dashboard', 'C_Guru\C_Guru::dashboard');
// guru/stok barang
$routes->get('/guru/stok_barang', 'C_Guru\C_Stok_Barang::stok_barang');
// guru/peminjaman
$routes->get('/guru/peminjaman', 'C_Guru\C_Peminjaman::peminjaman');
$routes->get('/guru/peminjaman/(:any)', 'C_Guru\C_Peminjaman::tambah_view/$1');
$routes->get('/guru/cetak_peminjaman/(:any)', 'C_Guru\C_Peminjaman::cetak_peminjaman/$1');
$routes->post('/guru/kembalikan/(:any)', 'C_Guru\C_Pengembalian::kembalikan/$1');
$routes->post('/guru/tambah_peminjaman', 'C_Guru\C_Peminjaman::tambah');
$routes->post('/guru/delete_peminjaman/(:any)', 'C_Guru\C_Peminjaman::delete/$1');
// guru/pengembalian
$routes->get('/guru/pengembalian', 'C_Guru\C_Pengembalian::pengembalian');
$routes->post('/guru/delete_pengembalian/(:any)', 'C_Guru\C_Pengembalian::delete/$1');
$routes->get('/guru/cetak_pengembalian/(:any)', 'C_Guru\C_Pengembalian::cetak_pengembalian/$1');

// kepala sekolah
$routes->get('/kepsek/dashboard', 'C_Kepsek\C_Kepsek::dashboard');
// kepsek/stok barang
$routes->get('/kepsek/stok_barang', 'C_Kepsek\C_Stok_Barang::stok_barang');
// kepsek laporan stok
$routes->get('/kepsek/laporan_stok', 'C_Kepsek\C_Stok_Barang::pilih_stok_view');
$routes->get('/kepsek/cetak_stok', 'C_Kepsek\C_Stok_Barang::cetak_stok');
// kepsek laporan Barang Masuk
$routes->get('/kepsek/laporan_barang_masuk', 'C_Kepsek\C_Barang_Masuk::pilih_barang_masuk');
$routes->post('/kepsek/cetak_barang_masuk', 'C_Kepsek\C_Barang_Masuk::cetak_barang_masuk');
// kepsek laporan Barang Keluar
$routes->get('/kepsek/laporan_barang_keluar', 'C_Kepsek\C_Barang_Keluar::pilih_barang_keluar');
$routes->post('/kepsek/cetak_barang_keluar', 'C_Kepsek\C_Barang_Keluar::cetak_barang_keluar');
// kepsek laporan Peminjaman
$routes->get('/kepsek/laporan_peminjaman', 'C_Kepsek\C_Peminjaman::pilih_peminjaman');
$routes->get('/kepsek/cetak_peminjaman', 'C_Kepsek\C_Peminjaman::cetak_peminjaman');
// kepsek laporan Pengembalian
$routes->get('/kepsek/laporan_pengembalian', 'C_Kepsek\C_Pengembalian::pilih_pengembalian');
$routes->get('/kepsek/cetak_pengembalian', 'C_Kepsek\C_Pengembalian::cetak_pengembalian');

// home
$routes->get('/', 'C_Home::index');
// stok barang
$routes->get('/stok_barang', 'C_Data_Barang\C_Stok_Barang::stok_barang');
$routes->post('/tambah_stok_barang', 'C_Data_Barang\C_Stok_Barang::tambah');
$routes->get('/edit_stok_barang/(:any)', 'C_Data_Barang\C_Stok_Barang::edit/$1');
$routes->post('/update_stok_barang/(:any)', 'C_Data_Barang\C_Stok_Barang::update/$1');
$routes->post('/delete_stok_barang/(:any)', 'C_Data_Barang\C_Stok_Barang::delete/$1');
// jenis barang
$routes->get('/jenis_barang', 'C_Data_Barang\C_Jenis_Barang::jenis_barang');
$routes->post('/tambah_jenis_barang', 'C_Data_Barang\C_Jenis_Barang::tambah');
$routes->get('/edit_jenis_barang/(:any)', 'C_Data_Barang\C_Jenis_Barang::edit/$1');
$routes->post('/update_jenis_barang/(:any)', 'C_Data_Barang\C_Jenis_Barang::update/$1');
$routes->post('/delete_jenis_barang/(:any)', 'C_Data_Barang\C_Jenis_Barang::delete/$1');
// satuan barang
$routes->get('/satuan_barang', 'C_Data_Barang\C_Satuan_Barang::satuan_barang');
$routes->post('/tambah_satuan_barang', 'C_Data_Barang\C_Satuan_Barang::tambah');
$routes->get('/edit_satuan_barang/(:any)', 'C_Data_Barang\C_Satuan_Barang::edit/$1');
$routes->post('/update_satuan_barang/(:any)', 'C_Data_Barang\C_Satuan_Barang::update/$1');
$routes->post('/delete_satuan_barang/(:any)', 'C_Data_Barang\C_Satuan_Barang::delete/$1');
// kondisi barang
$routes->get('/kondisi_barang', 'C_Data_Barang\C_Kondisi_Barang::kondisi_barang');
$routes->post('/tambah_kondisi_barang', 'C_Data_Barang\C_Kondisi_Barang::tambah');
$routes->get('/edit_kondisi_barang/(:any)', 'C_Data_Barang\C_Kondisi_Barang::edit/$1');
$routes->post('/update_kondisi_barang/(:any)', 'C_Data_Barang\C_Kondisi_Barang::update/$1');
$routes->post('/delete_kondisi_barang/(:any)', 'C_Data_Barang\C_Kondisi_Barang::delete/$1');
// barang masuk
$routes->get('/barang_masuk', 'C_Data_Barang\C_Barang_Masuk::barang_masuk');
$routes->post('/tambah_barang_masuk', 'C_Data_Barang\C_Barang_Masuk::tambah');
$routes->post('/delete_barang_masuk/(:any)', 'C_Data_Barang\C_Barang_Masuk::delete/$1');
// barang keluar
$routes->get('/barang_keluar', 'C_Data_Barang\C_Barang_Keluar::barang_keluar');
$routes->get('/barang_keluar/(:any)', 'C_Data_Barang\C_Barang_Keluar::tambah_view/$1');
$routes->post('/tambah_barang_keluar', 'C_Data_Barang\C_Barang_Keluar::tambah');
$routes->post('/delete_barang_keluar/(:any)', 'C_Data_Barang\C_Barang_Keluar::delete/$1');
// data suplier
$routes->get('/data_suplier', 'C_Data_Suplier::data_suplier');
$routes->post('/tambah_data_suplier', 'C_Data_Suplier::tambah');
$routes->get('/edit_data_suplier/(:any)', 'C_Data_Suplier::edit/$1');
$routes->post('/update_data_suplier/(:any)', 'C_Data_Suplier::update/$1');
$routes->post('/delete_data_suplier/(:any)', 'C_Data_Suplier::delete/$1');
// data user
$routes->get('/data_user', 'C_Data_user::data_user');
$routes->post('/tambah_data_user', 'C_Data_User::tambah');
$routes->get('/edit_data_user/(:any)', 'C_Data_User::edit/$1');
$routes->post('/update_data_user/(:any)', 'C_Data_User::update/$1');
$routes->post('/delete_data_user/(:any)', 'C_Data_User::delete/$1');
// peminjaman barang
$routes->get('/peminjaman', 'C_Peminjaman::peminjaman');
$routes->post('/delete_peminjaman/(:any)', 'C_Peminjaman::delete/$1');
$routes->post('/terima_peminjaman/(:any)', 'C_Peminjaman::terima/$1');
$routes->post('/tolak_peminjaman/(:any)', 'C_Peminjaman::tolak/$1');
// pengembalian
$routes->get('/pengembalian', 'C_Pengembalian::pengembalian');
$routes->post('/delete_pengembalian/(:any)', 'C_Pengembalian::delete/$1');
$routes->post('/terima_pengembalian/(:any)', 'C_Pengembalian::terima/$1');
$routes->post('/tolak_pengembalian/(:any)', 'C_Pengembalian::tolak/$1');
// laporan stok admin
$routes->get('/cetak_stok', 'C_Data_Barang\C_Stok_Barang::cetak_stok');
// admin laporan Barang Masuk
$routes->get('/laporan_barang_masuk', 'C_Data_Barang\C_Barang_Masuk::pilih_barang_masuk');
$routes->post('/cetak_barang_masuk', 'C_Data_Barang\C_Barang_Masuk::cetak_barang_masuk');
// admin laporan Barang Keluar
$routes->get('/laporan_barang_keluar', 'C_Data_Barang\C_Barang_Keluar::pilih_barang_keluar');
$routes->post('/cetak_barang_keluar', 'C_Data_Barang\C_Barang_Keluar::cetak_barang_keluar');
// kepsek laporan Peminjaman
$routes->get('/cetak_peminjaman', 'C_Peminjaman::cetak_peminjaman');
// kepsek laporan Pengembalian
$routes->get('/cetak_pengembalian', 'C_Peminjaman::cetak_peminjaman');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          riman form
            var selectedOption = document.getElementById("nama_barang").value;
            var url = "/barang_keluar/" + selectedOption;
            window.location.href = url; // Mengarahkan ke URL yang diinginkan
        });
    </script>

</body>

</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    