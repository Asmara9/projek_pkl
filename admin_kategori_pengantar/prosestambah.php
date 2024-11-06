<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Master Data kategori</title>
</head>

<body>
    <?php
    session_start();
    require_once '../database/config.php';

    if (isset($koneksi, $_POST['tambahkategori'])) {
        $keterangan = trim(mysqli_real_escape_string($koneksi, $_POST['keterangan']));
        $querycekkategori = mysqli_query($koneksi, "SELECT id_kategori FROM tbl_kategori_pengantar") or die(mysqli_error($koneksi));

        $returnvalue = mysqli_num_rows($querycekkategori);
        $tambahkategori = mysqli_query($koneksi, "INSERT INTO tbl_kategori_pengantar VALUES ('', '$keterangan')") or die(mysqli_error($koneksi));

    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data kategori dengan keterangan : <?= $keterangan; ?> berhasil dtambahkan", "success");

            setTimeout(function() {
                window.location.href = "../admin_kategori_pengantar";
            }, 3000);
        </script>



        <?php

    } else {
        if ($returnvalue == 0) {
        ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Duplikat Data", "Data kategori Dengan id kategori : <?= $id_kategori; ?>, keterangan : <?= $keterangan; ?> sudah ada dalam database", "error");

                setTimeout(function() {
                    window.location.href = "../admin_kategori_pengantar";
                }, 2000);
            </script>


    <?php
        }
    }
    ?>
</body>

</html>