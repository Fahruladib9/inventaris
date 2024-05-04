<html>

<head>
    <title>Cetak Bukti pengembalian</title>
    <style>
        @page {
            size: A4
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        .sheet {
            padding: 10mm;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        h1 {
            font-weight: bold;
            font-size: 16pt;
            text-align: center;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        h2 {
            font-weight: bold;
            font-size: 10pt;
            text-align: center;
            line-height: 0.5;
        }

        .banyuasin {
            width: 90px;
            float: left;
            margin-right: 10px;
        }

        .tut-wuri {
            width: 90px;
            float: right;
            margin-left: 10px;
            margin-top: -8px;
        }

        hr {
            border: none;
            border-top: 2px solid black;
            margin: 10px 0;
        }

        .satu {
            font-size: 17pt;
            text-align: center;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .alamat {
            font-weight: bold;
            font-size: 10pt;
            text-align: center;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-left: -25px;
        }

        table td {
            padding: 6px;
            border: 1px solid black;
        }

        .kode-pengembalian,
        .nama,
        .nama-barang,
        .jumlah,
        .keterangan,
        .tanggal-pengembalian,
        .tanggal-pengembalian {
            font-weight: bold;
        }

        .ttd {
            text-align: right;
            margin-top: 100px;
        }

        .pak-ahmat {
            position: relative;
            right: 70px;
            line-height: 0.5;
        }

        .tertanda {
            position: relative;
            right: 90px;
            line-height: 0.5;
            margin-bottom: 100px;
        }

        .nip {
            position: relative;
            right: 51px;
            line-height: 0.5;
        }
    </style>
</head>

<body class="A4">
    <section class="sheet">

        <img src="data:image/jpeg;base64,<?= $banyuasin; ?>" alt="" class="banyuasin">
        <img src="data:image/jpeg;base64,<?= $tutwuri; ?>" alt="" class="tut-wuri">
        <!-- <img src="/assets/img/tut wuri.png" alt="Logo Tut Wuri" class="tut-wuri"> -->

        <h1>PEMERINTAH KABUPATEN BANYUASIN</h1>
        <h1>DINAS PENDIDIKAN DAN KEBUDAYAAN</h1>
        <h1 class="satu">SDN 13 SUMBER MARGA TELANG</h1>
        <h2>NPSN : 10600153 NSS : 101110700153 – TERAKREDITASI A TAHUN 2019</h2>
        <p class="alamat">Jalur 3 – Jembatan 2, Desa Sumber Jaya, Kecamatan Sumber Marga Telang</p>
        <hr>

        <div class="container">
            <h1 style="margin-top: 30px; margin-bottom: 30px;">LAPORAN STOK BARANG</h1>
            <table>
                <thead style="font-size: 13pt; font-weight: bold;">
                    <tr>
                        <td>No.</td>
                        <td>Kode Barang</td>
                        <td>Nama Barang</td>
                        <td>Jenis Barang</td>
                        <td>Kondisi</td>
                        <td>Jumlah</td>
                        <td>Jumlah Dipinjam</td>
                        <td>Satuan</td>
                        <td>Tanggal Diperbarui</td>
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

            <div class="ttd">
                <p class="tertanda">Pengelola Inventaris,</p>
                <p>____________________________</p>
                <p class="pak-ahmat">Ahmat Sodikin, S.Pd.SD</p>
                <p class="nip">NIP. 196909102008011007</p>
            </div>
        </div>
    </section>
</body>

</html>