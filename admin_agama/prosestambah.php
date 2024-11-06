<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Master Data agama</title>
</head>

<body>
    <?php
    session_start();
    require_once '../database/config.php';

    if (isset($koneksi, $_POST['tambah'])) {
        $agama = trim(mysqli_real_escape_string($koneksi, $_POST['agama']));
        $querycekagama = mysqli_query($koneksi, "SELECT id FROM tbl_agama") or die(mysqli_error($koneksi));

        $returnvalue = mysqli_num_rows($querycekagama);
        $tambahagama = mysqli_query($koneksi, "INSERT INTO tbl_agama VALUES ('', '$agama')") or die(mysqli_error($koneksi));

    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data agama dengan nama agama : <?= $agama; ?> berhasil dtambahkan", "success");

            setTimeout(function() {
                window.location.href = "../admin_agama";
            }, 2000);
        </script>



        <?php

    } else {
        if ($returnvalue == 0) {
        ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Duplikat Data", "Data agama Dengan id : <?= $id; ?>, agama : <?= $agama; ?> sudah ada dalam database", "error");

                setTimeout(function() {
                    window.location.href = "../admin_agama";
                }, 2000);
            </script>


    <?php
        }
    }
    ?>
</body>

</html>