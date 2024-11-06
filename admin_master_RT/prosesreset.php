<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Reset Data rt</title>
</head>

<body>
    <?php
    require_once '../database/config.php';
    session_start();
    $reset = @$_GET['reset'];
    if ($reset == "reset") {
        $ambilidrt = mysqli_query($koneksi, "SELECT nik FROM tbl_rt") or die(mysqli_error($koneksi));
        $rvambilrt = mysqli_num_rows($ambilidrt);
        if ($rvambilrt == 0) {
    ?>
            <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Data Kosong", "Data RT Kosong", "info");
                setTimeout(function() {
                    window.location.href = "../admin_master_RT";
                }, 1500);
            </script>
        <?php
        } else {
            while ($data = mysqli_fetch_assoc($ambilidrt)) {
                $rt = $data['nik'];

                $queryhapus_pg_rt = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$rt'") or die(mysqli_error($koneksi));
            }
            $queryhapus_rt = mysqli_query($koneksi, "TRUNCATE TABLE tbl_rt") or die(mysqli_error($koneksi));
        }
        ?>
        <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data rt Berhasil di Reset", "success");
            setTimeout(function() {
                window.location.href = "../admin_master_RT";
            }, 1500);
        </script>
    <?php
    }
    ?>
</body>

</html>