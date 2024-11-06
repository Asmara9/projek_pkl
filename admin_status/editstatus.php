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

    if (isset($koneksi, $_POST['editrw'])) {

        $id = trim(mysqli_real_escape_string($koneksi, $_POST['id']));
        $keterangan = trim(mysqli_real_escape_string($koneksi, $_POST['ket']));

        $queryedit = mysqli_query($koneksi, "UPDATE tbl_status SET keterangan = '$keterangan' WHERE id_status='$id'") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data Status berhasil diedit", "success");

            setTimeout(function() {
                window.location.href = "../admin_status";
            }, 2000);
        </script>
    <?php
    }
    ?>
</body>

</html>