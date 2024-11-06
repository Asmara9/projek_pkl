<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Reset Data kategori</title>
</head>

<body>
    <?php
    require_once '../database/config.php';
    session_start();

    $ambilidkategori = mysqli_query($koneksi, "SELECT id_kategori FROM tbl_kategori_pengantar") or die(mysqli_error($koneksi));
    $rvambilkategori = mysqli_num_rows($ambilidkategori);
    if ($rvambilkategori == 0) {
    ?>
        <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Data Kosong", "Data kategori Kosong", "info");
            setTimeout(function() {
                window.location.href = "../admin_kategori_pengantar";
            }, 1500);
        </script>
    <?php
    } else {
        while ($data = mysqli_fetch_assoc($ambilidkategori)) {
            $kategori = $data['kategori'];

            $queryhapus_pg_kategori = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$kategori'") or die(mysqli_error($koneksi));
        }
        $queryhapus_kategori = mysqli_query($koneksi, "TRUNCATE TABLE tbl_kategori_pengantar") or die(mysqli_error($koneksi));
    }
    ?>
    <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("Berhasil", "Data kategori Berhasil di Reset", "success");
        setTimeout(function() {
            window.location.href = "../admin_kategori_pengantar";
        }, 1500);
    </script>

</body>

</html>