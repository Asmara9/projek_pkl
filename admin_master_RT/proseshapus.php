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

    $kd_rt = @$_GET['kd_rt'];
    $hapus = @$_GET['hapus'];
    $kodeDecrip = decriptData($kd_rt);
    if ($hapus == 'hapus') {
        $qrdelrt = mysqli_query($koneksi, "DELETE FROM tbl_rt WHERE nik='$kodeDecrip'") or die(mysqli_error($koneksi));
        $qrdelpenggunart = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$kodeDecrip'") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data RT berhasil dihapus", "success");

            setTimeout(function() {
                window.location.href = "../admin_master_RT";
            }, 2000);
        </script>
    <?php

    }
    ?>
</body>

</html>