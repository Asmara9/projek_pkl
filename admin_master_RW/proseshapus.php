<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Hapus</title>
</head>

<body>
    <?php
    require_once '../database/config.php';
    session_start();

    $kd_rw = @$_GET['kd_rw'];
    $hapus = @$_GET['hapus'];
    $kodeDecrip = decriptData($kd_rw);
    if ($hapus == 'hapus') {
        $qrdelrw = mysqli_query($koneksi, "DELETE FROM tbl_rw WHERE nik='$kodeDecrip'") or die(mysqli_error($koneksi));
        $qrdelpenggunarw = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$kodeDecrip'") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data RW berhasil dihapus", "success");

            setTimeout(function() {
                window.location.href = "../admin_master_RW";
            }, 2000);
        </script>
    <?php

    }
    ?>
</body>

</html>