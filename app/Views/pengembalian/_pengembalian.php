<?php $this->extend('layout/default.php'); ?>

<?php $this->section('title'); ?>
<title>Pengembalian Barang</title>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Pengembalian Barang</h1>
                <!-- pengembalian Barang Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pengembalian Barang</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPengembalianBarang; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Cetak Barang -->
                <div class="section-header mb-3 ml-4">
                    <a href="/cetak_pengembalian" class="btn btn-outline-primary">
                        <i class="fas fa-print"></i> Cetak
                    </a>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Pengembalian Barang</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Kode Pengembalian</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pengembalian as $key => $value) : ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $value->nama_user; ?></td>
                                            <td><?= $value->kode_pengembalian; ?></td>
                                            <td><?= $value->nama_barang; ?></td>
                                            <td><?= $value->jumlah; ?></td>
                                            <td><?= $value->created_at; ?></td>
                                            <td class="text-center">
                                                <!-- kalau statusnya di proses muncul button untuk terima atau tolak -->
                                                <?php if ($value->status == 'diproses') : ?>
                                                    <form action="/terima_pengembalian/<?= $value->id_pengembalian; ?>" method="post" class="d-inline"> <button class="btn btn-success btn-sm center">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                                <!-- kalau statusnya diterima atau ditolak munculkan pesan diterima atau ditolak -->
                                                <?php if ($value->status == 'diterima' || $value->status == 'ditolak') : ?>
                                                    <?= $value->status; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center d-flex justify-content-center">
                                                <!-- proses edit dan hapus data di ambil berdasarkan id data mana yg mau di hapus atau edit -->
                                                <form action="/delete_pengembalian/<?= $value->id_pengembalian; ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Mau Hapus Data')">
                                                    <button class="btn btn-danger btn-sm mx-1">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
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