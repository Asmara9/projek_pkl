<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once '../database/config.php';
    session_start();
    $nik = @$_GET['kd_penduduk'];
    $kodeDecript = decriptData($nik);
    $queryhapuspenduduk = mysqli_query($koneksi, "DELETE FROM tbl_penduduk WHERE nik='$kodeDecript'") or die(mysqli_error($koneksi));
    $queryhapus_pg_penduduk = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$kodeDecript'") or die(mysqli_error($koneksi));
    ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("Berhasil", "Data mahasiswa dengan nik: <?= $kodeDecript; ?>", "success");
        setTimeout(function() {
            window.location.href = "../admin_penduduk";
        }, 1500);
    </script>



</body>

</html>