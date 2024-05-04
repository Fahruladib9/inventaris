<?php $this->extend('layout/default.php'); ?>

<?php $this->section('title'); ?>
<title>Satuan Barang</title>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div id="wrapper">

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Satuan Barang</h1>

                <div class="container-fluid">
                    <div class="section-header-button mb-3">
                        <a href="/satuan_barang" class="btn btn-outline-primary">Kembali</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Satuan Barang</h6>
                        </div>
                        <div class="card-body">
                            <form action="/update_satuan_barang/<?= $satuan_barang->id_satuan; ?>" method="post" autocomplete="off">
                                <!-- <input type="hidden" name="_method" value="PUT"> -->
                                <div class="form-group">
                                    <label for="satuan barang">Satuan Barang *</label>
                                    <input type="text" name="satuan" class="form-control" value="<?= $satuan_barang->satuan; ?>" required>
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