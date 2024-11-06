<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pengajuan Surat</title>
</head>

<body>
    <?php
    session_start();
    require_once '../database/config.php';

    if (isset($koneksi, $_POST['tambah'])) {
        $id_kategori = trim(mysqli_real_escape_string($koneksi, $_POST['id_kategori']));
        function tanggalIndo($tanggal)
        {
            $bulanIndo = [
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember'
            ];

            $hariIndo = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];

            $day = date('l', strtotime($tanggal));
            $dayNum = date('d', strtotime($tanggal));
            $monthNum = date('n', strtotime($tanggal));
            $year = date('Y', strtotime($tanggal));

            return $hariIndo[$day] . ', ' . $dayNum . ' ' . $bulanIndo[$monthNum] . ' ' . $year;
        }

        // Mengambil tanggal saat ini
        $tgl = date('Y-m-d');
        $tanggalIndo = tanggalIndo($tgl);
        $status = 1;
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
        $tambahsurat = mysqli_query($koneksi, "INSERT INTO tbl_permohonan_surat VALUES ('', '$id_kategori', '$tanggalIndo', '', '', '', '$nik', '$nama', '$rt', '$rw', '$jeniskelamin', '$alamat', '$nohp', '$status', '$keterangan')") or die(mysqli_error($koneksi));

    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Pengajuan Surat berhasil dibuat", "success");

            setTimeout(function() {
                window.location.href = "../surat_dashboard";
            }, 2000);
        </script>
    <?php
    }
    ?>
</body>

</html>