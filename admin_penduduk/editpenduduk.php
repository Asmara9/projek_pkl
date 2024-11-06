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

    if (isset($koneksi, $_POST['editpenduduk'])) {
        $nik = trim(mysqli_real_escape_string($koneksi, $_POST['nik']));
        $nama = trim(mysqli_real_escape_string($koneksi, $_POST['nama']));
        $ttl = trim(mysqli_real_escape_string($koneksi, $_POST['ttl']));
        $rt = trim(mysqli_real_escape_string($koneksi, $_POST['rt']));
        $rw = trim(mysqli_real_escape_string($koneksi, $_POST['rw']));
        $jeniskelamin = trim(mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']));
        $alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
        $agama = trim(mysqli_real_escape_string($koneksi, $_POST['agama']));
        $pekerjaan = trim(mysqli_real_escape_string($koneksi, $_POST['pekerjaan']));
        $nohp = trim(mysqli_real_escape_string($koneksi, $_POST['no_hp']));

        $queryedit = mysqli_query($koneksi, "UPDATE tbl_penduduk SET nama = '$nama', ttl = '$ttl', rt = '$rt', rw = '$rw', jenis_kelamin = '$jeniskelamin', alamat = '$alamat', agama='$agama', pekerjaan='$pekerjaan', no_hp = '$nohp' WHERE nik='$nik'") or die(mysqli_error($koneksi));
        if (!$queryedit) {
            die('Error: ' . mysqli_error($con));
        }

        $queryeditpengguna = mysqli_query($koneksi, "UPDATE tbl_pengguna SET nama_user = '$nama' WHERE username='$nik'");
        if (!$queryeditpengguna) {
            die('Error: ' . mysqli_error($con));
        }
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data Penduduk berhasil diedit", "success");

            setTimeout(function() {
                window.location.href = "../admin_penduduk";
            }, 2000);
        </script>

    <?php
    }
    ?>
</body>

</html>