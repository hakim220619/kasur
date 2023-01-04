<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cetak Tempat Industri </title>
    <base href="<?php echo base_url(); ?>" />
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <style>
        table {
            border-collapse: collapse;
        }

        thead>tr {
            background-color: #0070C0;
            color: #f1f1f1;
        }

        thead>tr>th {
            background-color: #0070C0;
            color: #fff;
            padding: 10px;
            border-color: #fff;
        }

        th,
        td {
            padding: 2px;
        }

        th {
            color: #222;
        }

        body {
            font-family: Calibri;
        }
    </style>
</head>

<body onload="window.print();">

    <h4 align="center" style="margin-top:0px;"><u>Tempat Industri</u></h4>
    <b>

    </b>
    <br>
    <h2>Data Tempat Industri</h2>
    <table id="datatable" class="display table table-striped table-hover">
        <thead class="center">
            <tr>
                <th>NO</th>
                <th>Id Industri</th>
                <th>Nama Industri</th>
                <th>Nama Pemilik</th>
                <th>Telepon</th>
                <th>Kelurahan</th>
                <th>Alamat Industri</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Gambar</th>
                <th>Info</th>
            </tr>
        </thead>
        <tbody class="center">
            <?php
            $no = 1;
            foreach ($tempat_industri as $a) { ?>

                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $a->id_industri ?></td>
                    <td><?= $a->nama_industri ?></td>
                    <td><?= $a->nama_pemilik ?></td>
                    <td><?= $a->tlp_pemilik ?></td>
                    <td><?= $a->id_kelurahan ?></td>
                    <td><?= $a->alamat_industri ?></td>
                    <td><?= $a->latitude ?></td>
                    <td><?= $a->longitude ?></td>
                    <td>
                        <img class="myImgx" src='<?php echo base_url("assets/foto/tempat_industri/"); ?><?= $a->gambar_lokasi ?> ' width="100px" height="100px">
                    </td>
                    <td><?= $a->info ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>