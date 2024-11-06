<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Logo Title</title>
</head>

<body>
    <?php
    include '../database/config.php';
    session_start();

    if (isset($koneksi, $_POST['updtitle'])) {
        $file = $_FILES['logotitle']['name'];
        $ekstensi = explode(".", $file);
        $file_name = "img-logotitle" . round(microtime(true)) . "." . end($ekstensi);
        $temp_file = $_FILES['logotitle']['tmp_name'];
        $target_dir = "../img/";
        $file_upload = $target_dir . $file_name;
        $aksi_upload = move_uploaded_file($temp_file, $file_upload);

        $idlogo = "2";
        $update_logotitle = mysqli_query($koneksi, "UPDATE tbl_konfigurasi SET lokasi_file='$file_upload' WHERE id='$idlogo'") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Logo Title Desa berhasil diubah", "success");

            setTimeout(function() {
                window.location.href = "../konfigurasi_sistem";
            }, 2000);
        </script>
    <?php
    }

    ?>

</body>

</html>