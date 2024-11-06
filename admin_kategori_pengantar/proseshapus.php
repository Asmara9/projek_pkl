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

    $idkategori = @$_GET['kd_kategori'];

    $queryhapuskategori = mysqli_query($koneksi, "DELETE FROM tbl_kategori_pengantar WHERE id_kategori='$idkategori'") or die(mysqli_error($koneksi));


    ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("Berhasil", "Data kategori dengan id_kategori: <?= $idkategori; ?>", "success");
        setTimeout(function() {
            window.location.href = "../admin_kategori_pengantar";
        }, 1500);
    </script>



</body>

</html>