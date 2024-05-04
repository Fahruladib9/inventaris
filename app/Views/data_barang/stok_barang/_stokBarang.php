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
                        <a href="#" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalTambah">Tambah</a>
                        <a href="/cetak_stok" class="btn btn-outline-primary">
                            <i class="fas fa-print"></i> Cetak
                        </a>
                    </div>

                    <!-- form popup ketika di klik tambah -->
                    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="/tambah_stok_barang" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Stok</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Tambahkan elemen-elemen form di sini -->
                                        <div class="form-group">
                                            <label for="kode barang">Kode Barang:</label>
                                            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $newKodeBarang; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama Barang:</label>
                                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis barang">jenis barang:</label>
                                            <select class="form-control selectSearch" id="selectSearch" name="jenis_barang" required>
                                                <option value="" selected disabled>-- Pilih Jenis Barang --</option>
                                                <?php foreach ($jenis_barang as $key => $value) : ?>
                                                    <option value="<?= $value->jenis_barang; ?>"><?= $value->jenis_barang; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan:</label>
                                            <select class="form-control selectSearch" id="selectSearch" name="satuan" required>
                                                <option value="" selected disabled>-- Pilih Satuan --</option>
                                                <?php foreach ($satuan_barang as $key => $value) : ?>
                                                    <option value="<?= $value->satuan; ?>"><?= $value->satuan; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kondisi">kondisi:</label>
                                            <select class="form-control selectSearch" id="selectSearch" name="kondisi" required>
                                                <option value="" selected disabled>-- Pilih Kondisi --</option>
                                                <?php foreach ($kondisi_barang as $key => $value) : ?>
                                                    <option value="<?= $value->kondisi; ?>"><?= $value->kondisi; ?></option>
                                                <?php endforeach; ?>
                                            </select>
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
                                            <th>Jumlah</th>
                                            <th>Jumlah Dipinjam</th>
                                            <th>Satuan</th>
                                            <th>Tanggal Pembaruan</th>
                                            <th>Action</th>
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
                                                <td class="text-center">
                                                    <!-- proses edit dan hapus data di ambil berdasarkan id data mana yg mau di hapus atau edit -->
                                                    <a href="/edit_stok_barang/<?= $value->id_stokBarang  ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                    <form action="delete_stok_barang/<?= $value->id_stokBarang; ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Mau Hapus Data')">
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