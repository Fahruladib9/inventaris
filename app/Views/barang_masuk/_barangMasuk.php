<?php $this->extend('layout/default.php'); ?>

<?php $this->section('title'); ?>
<title>Barang Masuk</title>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Barang Masuk</h1>
                <!-- Barang Masuk Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Barang Masuk</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahbarangmasuk; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
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
                            <form action="/tambah_barang_masuk" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Barang Masuk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Tambahkan elemen-elemen form di sini -->
                                    <div class="form-group">
                                        <label for="kode_transaksi">Kode Transaksi:</label>
                                        <input type="text" class="form-control" id="kode_transaksi" name="kode_transaksi" value="<?= $newKodeTransaksi; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang:</label>
                                        <select class="form-control selectSearch" id="nama_barang" name="nama_barang" required>
                                            <option value="" selected disabled>-- Pilih Nama Barang --</option>
                                            <?php foreach ($nama_barang as $key => $value) : ?>
                                                <option value="<?= $value->nama_barang; ?>"><?= $value->nama_barang; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="suplier">Suplier:</label>
                                        <select class="form-control selectSearch" id="suplier" name="suplier" required>
                                            <option value="" selected disabled>-- Pilih Suplier --</option>
                                            <?php foreach ($suplier as $key => $value) : ?>
                                                <option value="<?= $value->suplier; ?>"><?= $value->suplier; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah:</label>
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Masuk:</label>
                                        <input type="date" name="tanggal" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Barang Masuk</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Transaksi</th>
                                        <th>Nama Barang</th>
                                        <th>Suplier</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($barang_masuk as $key => $value) : ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $value->kode_transaksi; ?></td>
                                            <td><?= $value->nama_barang; ?></td>
                                            <td><?= $value->suplier; ?></td>
                                            <td><?= $value->jumlah; ?></td>
                                            <td><?= $value->tanggal; ?></td>
                                            <td class="text-center">
                                                <!-- proses edit dan hapus data di ambil berdasarkan id data mana yg mau di hapus atau edit -->
                                                <form action="delete_barang_masuk/<?= $value->id_barangMasuk; ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Mau Hapus Data')">
                                                    <button class="btn btn-danger btn-sm">
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