<?php $this->extend('layout/guru.php'); ?>

<?php $this->section('title'); ?>
<title>Peminjaman Barang</title>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Peminjaman Barang</h1>
                <!-- Peminjaman Barang Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Peminjaman Barang</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPeminjamanBarang; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button Tambah Barang -->
                <div class="section-header mb-3 ml-4">
                    <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalTambah">Tambah</a>
                </div>
                <!-- form popup ketika di klik tambah -->
                <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="formPeminjaman">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cari Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Tambahkan elemen-elemen form di sini -->
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang:</label>
                                        <select class="form-control selectSearch" id="nama_barang" name="nama_barang" required>
                                            <option value="" selected disabled>-- Pilih Nama Barang --</option>
                                            <?php foreach ($stok_barang as $key => $value) : ?>
                                                <option value="<?= $value->id_stokBarang; ?>"><?= $value->nama_barang; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Cari Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Peminjaman Barang</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Peminjaman</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($peminjaman as $key => $value) : ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $value->kode_peminjaman; ?></td>
                                            <td><?= $value->nama_barang; ?></td>
                                            <td><?= $value->jumlah; ?></td>
                                            <td><?= $value->keterangan; ?></td>
                                            <td><?= $value->tanggal_peminjaman; ?></td>
                                            <td><?= $value->tanggal_pengembalian; ?></td>
                                            <td><?= $value->status; ?></td>
                                            <td class="text-center d-flex justify-content-center">
                                                <?php if ($value->status == 'diterima') : ?>
                                                    <a href="/guru/cetak_peminjaman/<?= $value->id_peminjaman  ?>" class="btn btn-warning btn-sm mx-1"><i class="fas fa-print"></i></a>
                                                    <form action="/guru/kembalikan/<?= $value->id_peminjaman; ?>" method="post" class="d-inline">
                                                        <button class="btn btn-danger btn-sm mx-1">
                                                            <i class="fas fa-reply"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                                <?php if ($value->status == 'diproses') : ?>
                                                    <!-- proses edit dan hapus data di ambil berdasarkan id data mana yg mau di hapus atau edit -->
                                                    <form action="/guru/delete_peminjaman/<?= $value->id_peminjaman; ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Mau Hapus Data')">
                                                        <button class="btn btn-danger btn-sm mx-1">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
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