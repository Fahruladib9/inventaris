<?php $this->extend('layout/kepsek.php'); ?>

<?php $this->section('title'); ?>
<title>Stok Barang</title>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Stok Barang</h1>
                <!-- Stok Barang Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
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
                </div>
                <!-- Button Tambah Barang -->
                <div class="section-header mb-3 ml-4">
                    <a href="/kepsek/cetak_stok" class="btn btn-outline-primary">
                        <i class="fas fa-print"></i> Cetak
                    </a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Stok Barang</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Kondisi</th>
                                        <th>Jumlah </th>
                                        <th>Jumlah Dipinjam</th>
                                        <th>Satuan</th>
                                        <th>Tanggal Pembaruan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stok_barang as $key => $value) : ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $value->kode_barang; ?></td>
                                            <td><?= $value->nama_barang; ?></td>
                                            <td><?= $value->jenis_barang; ?></td>
                                            <td><?= $value->kondisi; ?></td>
                                            <td><?= $value->jumlah; ?></td>
                                            <td><?= $value->jumlah_dipinjam; ?></td>
                                            <td><?= $value->satuan; ?></td>
                                            <td><?= $value->updated_at; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Inventaris SDN 13 Sumber Marga Telang</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>

    <?php $this->endSection(); ?>