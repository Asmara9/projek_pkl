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

    if (isset($koneksi, $_POST['updatedesa'])) {
        $nama_desa = trim(mysqli_escape_string($koneksi, $_POST['desa']));



        $id = "5";
        $update_nama_desa = mysqli_query($koneksi, "UPDATE tbl_konfigurasi SET elemen='$nama_desa' WHERE id='$id'") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Nama Desa berhasil diubah", "success");

            setTimeout(function() {
                window.location.href = "../konfigurasi_sistem";
            }, 2000);
        </script>
    <?php
    }

    ?>

</body>

</html>