<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'login'         => \App\Filters\AuthFilter::class,
        'admin'         => \App\Filters\AdminFilter::class,
        'guru'          => \App\Filters\GuruFilter::class,
        'kepsek'        => \App\Filters\KepsekFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',

        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        // jika belum login tidak bisa mengakses url berikut :
        'login' => ['before' => [
            '/', 'stok_barang', '/tambah_stok_barang', '/edit_stok_barang/(:any)', '/update_stok_barang/(:any)', '/delete_stok_barang/(:any)', '/jenis_barang', '/tambah_jenis_barang', '/edit_jenis_barang/(:any)', '/update_jenis_barang/(:any)', '/delete_jenis_barang/(:any)', '/satuan_barang', '/tambah_satuan_barang', '/edit_satuan_barang/(:any)', '/update_satuan_barang/(:any)', '/delete_satuan_barang/(:any)', '/kondisi_barang', '/tambah_kondisi_barang', '/edit_kondisi_barang/(:any)', '/update_kondisi_barang/(:any)', '/delete_kondisi_barang/(:any)', '/barang_masuk', '/tambah_barang_masuk', '/delete_barang_masuk/(:any)', '/barang_keluar', '/barang_keluar/(:any)', '/tambah_barang_keluar', '/delete_barang_keluar/(:any)', '/data_suplier', '/tambah_data_suplier', '/edit_data_suplier/(:any)', '/update_data_suplier/(:any)', '/delete_data_suplier/(:any)', '/data_user', '/tambah_data_user', '/edit_data_user/(:any)', '/update_data_user/(:any)', '/delete_data_user/(:any)', '/guru/*', '/peminjaman', '/delete_peminjaman/(:any)', '/terima_peminjaman/(:any)', '/tolak_peminjaman/(:any)', '/pengembalian', '/delete_pengembalian/(:any)', '/terima_pengembalian/(:any)', '/tolak_pengembalian/(:any)', '/cetak_pengembalian', '/cetak_peminjaman', '/cetak_barang_keluar', '/laporan_barang_keluar', '/cetak_barang_masuk', '/laporan_barang_masuk', '/cetak_stok', 'kepsek/*',
        ]],
        // jika login sebagai admin tidak bisa mengakses url berikut :
        'admin' => ['before' => [
            'guru/*', 'kepsek/*',
        ]],
        // jika login sebagai guru tidak bisa mengakses url berikut :
        'guru' => ['before' => [
            '/', 'stok_barang', '/tambah_stok_barang', '/edit_stok_barang/(:any)', '/update_stok_barang/(:any)', '/delete_stok_barang/(:any)', '/jenis_barang', '/tambah_jenis_barang', '/edit_jenis_barang/(:any)', '/update_jenis_barang/(:any)', '/delete_jenis_barang/(:any)', '/satuan_barang', '/tambah_satuan_barang', '/edit_satuan_barang/(:any)', '/update_satuan_barang/(:any)', '/delete_satuan_barang/(:any)', '/kondisi_barang', '/tambah_kondisi_barang', '/edit_kondisi_barang/(:any)', '/update_kondisi_barang/(:any)', '/delete_kondisi_barang/(:any)', '/barang_masuk', '/tambah_barang_masuk', '/delete_barang_masuk/(:any)', '/barang_keluar', '/barang_keluar/(:any)', '/tambah_barang_keluar', '/delete_barang_keluar/(:any)', '/data_suplier', '/tambah_data_suplier', '/edit_data_suplier/(:any)', '/update_data_suplier/(:any)', '/delete_data_suplier/(:any)', '/data_user', '/tambah_data_user', '/edit_data_user/(:any)', '/update_data_user/(:any)', '/delete_data_user/(:any)', '/kepsek/*', '/peminjaman', '/delete_peminjaman/(:any)', '/terima_peminjaman/(:any)', '/tolak_peminjaman/(:any)', '/pengembalian', '/delete_pengembalian/(:any)', '/terima_pengembalian/(:any)', '/tolak_pengembalian/(:any)', '/cetak_pengembalian', '/cetak_peminjaman', '/cetak_barang_keluar', '/laporan_barang_keluar', '/cetak_barang_masuk', '/laporan_barang_masuk', '/cetak_stok',
        ]],
        // jika login sebagai kepsek tidak bisa mengakses url berikut :
        'kepsek' => ['before' => [
            '/', 'stok_barang', '/tambah_stok_barang', '/edit_stok_barang/(:any)', '/update_stok_barang/(:any)', '/delete_stok_barang/(:any)', '/jenis_barang', '/tambah_jenis_barang', '/edit_jenis_barang/(:any)', '/update_jenis_barang/(:any)', '/delete_jenis_barang/(:any)', '/satuan_barang', '/tambah_satuan_barang', '/edit_satuan_barang/(:any)', '/update_satuan_barang/(:any)', '/delete_satuan_barang/(:any)', '/kondisi_barang', '/tambah_kondisi_barang', '/edit_kondisi_barang/(:any)', '/update_kondisi_barang/(:any)', '/delete_kondisi_barang/(:any)', '/barang_masuk', '/tambah_barang_masuk', '/delete_barang_masuk/(:any)', '/barang_keluar', '/barang_keluar/(:any)', '/tambah_barang_keluar', '/delete_barang_keluar/(:any)', '/data_suplier', '/tambah_data_suplier', '/edit_data_suplier/(:any)', '/update_data_suplier/(:any)', '/delete_data_suplier/(:any)', '/data_user', '/tambah_data_user', '/edit_data_user/(:any)', '/update_data_user/(:any)', '/delete_data_user/(:any)', '/guru/*', '/peminjaman', '/delete_peminjaman/(:any)', '/terima_peminjaman/(:any)', '/tolak_peminjaman/(:any)', '/pengembalian', '/delete_pengembalian/(:any)', '/terima_pengembalian/(:any)', '/tolak_pengembalian/(:any)', '/cetak_pengembalian', '/cetak_peminjaman', '/cetak_barang_keluar', '/laporan_barang_keluar', '/cetak_barang_masuk', '/laporan_barang_masuk', '/cetak_stok',
        ]],
    ];
}
