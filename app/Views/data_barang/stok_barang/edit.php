<?php $this->extend('layout/default.php'); ?>

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
                <h1 class="h3 mb-4 text-gray-800">Stok Barang</h1>

                <div class="container-fluid">
                    <div class="section-header-button mb-3">
                        <a href="/stok_barang" class="btn btn-outline-primary">Kembali</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit stok Barang</h6>
                        </div>
                        <div class="card-body">
                            <form action="/update_stok_barang/<?= $stok_barang->id_stokBarang; ?>" method="post" autocomplete="off">
                                <!-- <input type="hidden" name="_method" value="PUT"> -->
                                <div class="form-group">
                                    <label for="kode barang">Kode Barang</label>
                                    <input type="text" name="kode_barang" class="form-control" value="<?= $stok_barang->kode_barang; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="nama barang">Nama Barang*</label>
                                    <input type="text" name="nama_barang" class="form-control" value="<?= $stok_barang->nama_barang; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="jenis barang">jenis barang:</label>
                                    <select class="form-control selectSearch" id="jenis_barang" name="jenis_barang">
                                        <?php foreach ($jenis_barang as $key => $value) : ?>
                                            <option value="<?= $value->jenis_barang; ?>"><?= $value->jenis_barang; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kondisi">kondisi:</label>
                                    <select class="form-control selectSearch" id="kondisi" name="kondisi">
                                        <?php foreach ($kondisi_barang as $key => $value) : ?>
                                            <option value="<?= $value->kondisi; ?>"><?= $value->kondisi; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah*</label>
                                    <input type="text" name="jumlah" class="form-control" value="<?= $stok_barang->jumlah; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan:</label>
                                    <select class="form-control selectSearch" id="satuan" name="satuan">
                                        <?php foreach ($satuan_barang as $key => $value) : ?>
                                            <option value="<?= $value->satuan; ?>"><?= $value->satuan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success mx-2"><i class="fas fa-paper-plane"></i> Update</button>
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