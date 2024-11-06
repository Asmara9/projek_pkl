<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Reset Data rw</title>
</head>

<body>
    <?php
    require_once '../database/config.php';
    session_start();
    $reset = @$_GET['reset'];
    if ($reset == "reset") {
        $ambilidrw = mysqli_query($koneksi, "SELECT nik FROM tbl_rw") or die(mysqli_error($koneksi));
        $rvambilrw = mysqli_num_rows($ambilidrw);
        if ($rvambilrw == 0) {
    ?>
            <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Data Kosong", "Data rw Kosong", "info");
                setTimeout(function() {
                    window.location.href = "../admin_master_RW";
                }, 1500);
            </script>
        <?php
        } else {
            while ($data = mysqli_fetch_assoc($ambilidrw)) {
                $rw = $data['nik'];

                $queryhapus_pg_rw = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$rw'") or die(mysqli_error($koneksi));
            }
            $queryhapus_rw = mysqli_query($koneksi, "TRUNCATE TABLE tbl_rw") or die(mysqli_error($koneksi));
        }
        ?>
        <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data rw Berhasil di Reset", "success");
            setTimeout(function() {
                window.location.href = "../admin_master_RW";
            }, 1500);
        </script>
    <?php
    }
    ?>
</body>

</html>