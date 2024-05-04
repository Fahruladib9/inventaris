<?php $this->extend('layout/default.php'); ?>

<?php $this->section('title'); ?>
<title>Tambah Barang</title>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Tambah Barang</h1>

                <div class="container-fluid">
                    <div class="section-header-button mb-3">
                        <a href="/barang_keluar" class="btn btn-outline-primary">Kembali</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
                        </div>
                        <div class="card-body">
                            <form action="/tambah_barang_keluar" method="post" autocomplete="off">
                                <!-- <input type="hidden" name="_method" value="PUT"> -->
                                <div class="form-group">
                                    <label for="kode_transaksi">Kode Transaksi *</label>
                                    <input type="text" name="kode_transaksi" class="form-control" value="<?= $newKodeTransaksi; ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang *</label>
                                    <input type="text" name="kode_barang" class="form-control" value="<?= $stok_tambah->kode_barang; ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang *</label>
                                    <input type="text" name="nama_barang" class="form-control" value="<?= $stok_tambah->nama_barang; ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_stok">Jumlah Stok *</label>
                                    <input type="number" name="jumlah_stok" class="form-control" value="<?= $stok_tambah->jumlah; ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Barang Keluar *</label>
                                    <input type="number" name="jumlah" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan *</label>
                                    <input type="text" name="keterangan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal *</label>
                                    <input type="date" name="tanggal" class="form-control" required>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success mx-2"><i class="fas fa-paper-plane"></i> Tambah</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
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