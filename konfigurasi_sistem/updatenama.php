<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Logo App</title>
</head>

<body>
    <?php
    include '../database/config.php';
    session_start();

    if (isset($koneksi, $_POST['gantinama'])) {
        $nama = trim(mysqli_escape_string($koneksi, $_POST['appname']));



        $id = "3";
        $update_nama = mysqli_query($koneksi, "UPDATE tbl_konfigurasi SET elemen='$nama' WHERE id='$id'") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Nama App Desa berhasil diubah", "success");

            setTimeout(function() {
                window.location.href = "../konfigurasi_sistem";
            }, 2000);
        </script>
    <?php
    }

    ?>

</body>

</html>