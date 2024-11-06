<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Tambah Master Data RW</title>
</head>

<body>
    <?php
    session_start();
    require_once '../database/config.php';

    if (isset($koneksi, $_POST['tambahrw'])) {
        $nik = trim(mysqli_real_escape_string($koneksi, $_POST['nik']));
        $rw = trim(mysqli_real_escape_string($koneksi, $_POST['rw']));
        $ketua = trim(mysqli_real_escape_string($koneksi, $_POST['ketua']));
        $kontak = trim(mysqli_real_escape_string($koneksi, $_POST['kontak']));
        $alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
        $password = sha1($nik);
        $stt_rw = "1";


        $querycekrw = mysqli_query($koneksi, "SELECT nik FROM tbl_rw") or die(mysqli_error($koneksi));

        $returnvalue = mysqli_num_rows($querycekrw);
        $tambahrw = mysqli_query($koneksi, "INSERT INTO tbl_rw (nik, rw, ketua, kontak, alamat) VALUES ('$nik', '$rw', '$ketua', '$kontak', '$alamat')") or die(mysqli_error($koneksi));
        $tambahpengguna = mysqli_query($koneksi, "INSERT INTO tbl_pengguna VALUES ('$nik', '$password', '$ketua', '$stt_rw')") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data RW Dengan nik : <?= $nik; ?>, Nama : <?= $ketua; ?> berhasil dtambahkan", "success");

            setTimeout(function() {
                window.location.href = "../admin_master_RW";
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