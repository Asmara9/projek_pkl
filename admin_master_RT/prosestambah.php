<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Master Data penduduk</title>
</head>

<body>
    <?php
    session_start();
    require_once '../database/config.php';

    if (isset($koneksi, $_POST['tambahrt'])) {
        $nik = trim(mysqli_real_escape_string($koneksi, $_POST['nik']));
        $rt = trim(mysqli_real_escape_string($koneksi, $_POST['rt']));
        $rw = trim(mysqli_real_escape_string($koneksi, $_POST['rw']));
        $ketua = trim(mysqli_real_escape_string($koneksi, $_POST['ketua']));
        $kontak = trim(mysqli_real_escape_string($koneksi, $_POST['kontak']));
        $alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
        $password = sha1($nik);
        $stt_rt = "3";

        $querycekrt = mysqli_query($koneksi, "SELECT nik FROM tbl_rt") or die(mysqli_error($koneksi));

        $returnvalue = mysqli_num_rows($querycekrt);
        $tambahrt = mysqli_query($koneksi, "INSERT INTO tbl_rt (nik, rt, ketua, kontak, alamat) VALUES ('$nik', '$rt', '$rw', '$ketua', '$kontak', '$alamat')") or die(mysqli_error($koneksi));
        $tambahpengguna = mysqli_query($koneksi, "INSERT INTO tbl_pengguna VALUES ('$nik', '$password', '$ketua', '$stt_rt')") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data RT Dengan nik : <?= $nik; ?>, Nama : <?= $ketua; ?> berhasil dtambahkan", "success");

            setTimeout(function() {
                window.location.href = "../admin_master_RT";
            }, 2000);
        </script>



        <?php

    } else {
        if ($returnvalue == 0) {
        ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Duplikat Data", "Data penduduk Dengan nik : <?= $nik; ?>, Nama : <?= $nama; ?> sudah ada dalam database", "error");

                setTimeout(function() {
                    window.location.href = "../admin_penduduk";
                }, 2000);
            </script>


    <?php
        }
    }
    ?>
</body>

</html>