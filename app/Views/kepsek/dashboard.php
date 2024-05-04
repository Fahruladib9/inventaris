<?php $this->extend('layout/kepsek.php') ?>

<?= $this->section('title'); ?>
<title>Dashboard</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Selamat Datang <?= $nama; ?></h1>
                </div>
                <center>
                    <h1 class="h5 ml-2 mb-0 text-gray-800">اَلسَّلَامُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَا تُهُ</h1>
                </center>
                <hr>
                <!-- Content Row -->
                <div class="row">
                    <!-- Barang Masuk Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Barang Masuk</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahBarangMasuk; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Barang Keluar Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Barang Keluar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahBarangKeluar; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Pengajuan Peminjaman Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Peminjaman</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPeminjamanBarang; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Pengembalian Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Pengembalian</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPengembalianBarang; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-reply fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Stok Barang Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <a href="#" class="text-decoration-none">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Stok Barang</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahStokBarang; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            <footer class="sticky-footer bg-white" style="margin-top: 30%;">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Inventaris SDN 13 Sumber Marga Telang</span>
                    </div>
                </div>
            </footer>

            <!-- <div class="mb-4">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </div> -->
        </div>
    </div>

    <?= $this->endSection(); ?>