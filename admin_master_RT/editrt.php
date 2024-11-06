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

    if (isset($koneksi, $_POST['editrt'])) {
        $nik = trim(mysqli_real_escape_string($koneksi, $_POST['nik']));
        $rt = trim(mysqli_real_escape_string($koneksi, $_POST['rt']));
        $ketua = trim(mysqli_real_escape_string($koneksi, $_POST['ketua']));
        $kontak = trim(mysqli_real_escape_string($koneksi, $_POST['kontak']));
        $alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));

        $queryedit = mysqli_query($koneksi, "UPDATE tbl_rt SET ketua = '$ketua', kontak = '$kontak', alamat = '$alamat' WHERE nik='$nik'") or die(mysqli_error($koneksi));

        $queryeditpengguna = mysqli_query($koneksi, "UPDATE tbl_pengguna SET nama_user = '$ketua' WHERE username='$nik'");
        if (!$queryeditpengguna) {
            die('Error: ' . mysqli_error($con));
        }

    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data RT berhasil diedit", "success");

            setTimeout(function() {
                window.location.href = "../admin_master_RT";
            }, 2000);
        </script>

    <?php
    }
    ?>
</body>

</html>