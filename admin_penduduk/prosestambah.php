<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Master Data penduduk</title>
</head>

<body>
    <?php
    session_start();
    require_once '../database/config.php';

    if (isset($koneksi, $_POST['tambahpenduduk'])) {
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
        $password = sha1($nik);
        $stt_penduduk = "2";

        $querycekpenduduk = mysqli_query($koneksi, "SELECT nik FROM tbl_penduduk") or die(mysqli_error($koneksi));

        $returnvalue = mysqli_num_rows($querycekpenduduk);
        $tambahpenduduk = mysqli_query($koneksi, "INSERT INTO tbl_penduduk VALUES ('$nik', '$nama', '$ttl', '$rt', '$rw', '$jeniskelamin', '$alamat', '$agama', '$pekerjaan', '$nohp')") or die(mysqli_error($koneksi));
        $tambahpengguna = mysqli_query($koneksi, "INSERT INTO tbl_pengguna VALUES ('$nik', '$password', '$nama', '$stt_penduduk')") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data penduduk Dengan nik : <?= $nik; ?>, Nama : <?= $nama; ?> berhasil dtambahkan", "success");
            setTimeout(function() {
                window.location.href = "../admin_penduduk";
            }, 2000);
        </script>
        <?php
    } else {
        if ($returnvalue == 0) {
        ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Duplikat Data", "Data penduduk Dengan nik : <?= $nik; ?>, Nama : <?= $nama; ?> sudah ada dalam database", "error");

                setTimeout(function() {
                    window.location.href = "../admin_penduduk";
                }, 2000);
            </script>


    <?php
        }
    }
    ?>
</body>

</html>