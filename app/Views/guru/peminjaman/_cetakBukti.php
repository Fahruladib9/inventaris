<html>

<head>
    <title>Cetak Bukti Peminjaman</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 5px;
        }

        .kode-peminjaman,
        .nama,
        .nama-barang,
        .jumlah,
        .keterangan,
        .tanggal-peminjaman,
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
            <h1 style="margin-top: 30px; margin-bottom: 30px;">BUKTI PEMINJAMAN</h1>
            <table>
                <tr>
                    <td>Kode Peminjaman</td>
                    <td>: <?= $peminjaman->kode_peminjaman; ?></td>
                </tr>
                <tr>
                    <td>Nama Peminjam</td>
                    <td>: <?= $peminjaman->nama_user; ?></td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>: <?= $peminjaman->nama_barang; ?></td>
                </tr>
                <tr>
                    <td>Jumlah Peminjaman</td>
                    <td>: <?= $peminjaman->jumlah; ?></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>: <?= $peminjaman->keterangan; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Peminjaman</td>
                    <td>: <?= $peminjaman->tanggal_peminjaman; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Pengembalian</td>
                    <td>: <?= $peminjaman->tanggal_pengembalian; ?></td>
                </tr>
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