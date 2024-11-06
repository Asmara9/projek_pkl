<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Request</title>
</head>

<body>
    <?php
    session_start();
    require_once '../database/config.php';

    if (isset($koneksi, $_POST['tambah'])) {
        $id_request = trim(mysqli_real_escape_string($koneksi, $_POST['id_request']));
        $tgl = date('Y-m-d');
        $id_req_tgl = $tgl . $id_request;
        $nik = @$_SESSION['username'];
        $keterangan = trim(mysqli_real_escape_string($koneksi, $_POST['keterangan']));
        $pglpenduduk = mysqli_query($koneksi, "SELECT * FROM tbl_penduduk WHERE nik='$nik'") or die(mysqli_error($koneksi));
        $data = mysqli_fetch_array($pglpenduduk);
        $nama = $data['nama'];
        $rt = $data['rt'];
        $rw = $data['rw'];
        $jeniskelamin = $data['jenis_kelamin'];
        $alamat = $data['alamat'];
        $nohp = $data['no_hp'];

        $querycekpenduduk = mysqli_query($koneksi, "SELECT * FROM tbl_permohonan_surat WHERE nik='$nik'") or die(mysqli_error($koneksi));

        $returnvalue = mysqli_num_rows($querycekpenduduk);
        $tambahsurat = mysqli_query($koneksi, "INSERT INTO tbl_permohonan_surat VALUES ('', '$id_kategori', '$tgl', '$nik', '$nama', '$rt', '$rw', '$jeniskelamin', '$alamat', '$nohp', '$status', '$keterangan')") or die(mysqli_error($koneksi));

    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Request berhasil dibuat", "success");

            setTimeout(function() {
                window.location.href = "../penduduk_laporan_pengajuan";
            }, 2000);
        </script>
    <?php
    }
    ?>
</body>

</html>