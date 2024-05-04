<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sebuah sistem untuk mengelola data inventaris pada SDN 13 Sumber Marga Telang">
    <meta name="keywords" content="inventaris, sistem inventaris, sdn 13 sumber marga telang, inventory, inventaris sdn 13 sumber marga telang">
    <meta name="author" content="fahrul adib">


    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/template/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <!-- menambahkan allert error ketika data gagal ditambahkan -->
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">x</button>
                                                <b>Error !</b>
                                                <?= session()->getFlashdata('error'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <form action="/proses_login" method="post">
                                        <div class="form-group">
                                            <label for="username">Username :</label>
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password :</label>
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/template/vendor/jquery/jquery.min.js"></script>
    <script src="/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/template/js/sb-admin-2.min.js"></script>
    <script>
        // mengambil dari Flashdata dari controller
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire(
                '<?= session()->getFlashdata('success'); ?>',
                '<?= session()->getFlashdata('pesan'); ?>',
                '<?= session()->getFlashdata('icon'); ?>'
            )
        <?php endif; ?>
    </script>

</body>

</html>