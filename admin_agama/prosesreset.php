<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Reset Data agama</title>
</head>

<body>
    <?php
    require_once '../database/config.php';
    session_start();

    $ambilidagama = mysqli_query($koneksi, "SELECT id FROM tbl_agama") or die(mysqli_error($koneksi));
    $rvambilidagama = mysqli_num_rows($ambilidagama);
    if ($rvambilidagama == 0) {
    ?>
        <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Data Kosong", "Data Agama Kosong", "info");
            setTimeout(function() {
                window.location.href = "../admin_agama";
            }, 1500);
        </script>
    <?php
    } else {
        while ($data = mysqli_fetch_assoc($ambilidagama)) {
            $agama = $data['agama'];
            $queryhapus_pg_agama = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$agama'") or die(mysqli_error($koneksi));
        }
        $queryhapus_agama = mysqli_query($koneksi, "TRUNCATE TABLE tbl_agama") or die(mysqli_error($koneksi));
    }
    ?>
    <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("Berhasil", "Data agama Berhasil di Reset", "success");
        setTimeout(function() {
            window.location.href = "../admin_agama";
        }, 1500);
    </script>

</body>

</html>