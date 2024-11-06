<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses ACC</title>
</head>

<body>
    <?php
    require_once '../database/config.php';
    session_start();

    $kd_pengajuan = @$_GET['kd_pengajuan'];
    $acc = @$_GET['acc'];
    $kodeDecrip = decriptData($kd_pengajuan);
    if ($acc == 'acc') {
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
        $qrdelrt = mysqli_query($koneksi, "UPDATE tbl_permohonan_surat SET status = 4, tgl_acc_admin='$tanggalIndo' WHERE id_permohonan='$kodeDecrip'") or die(mysqli_error($koneksi));
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Data Pengajuan berhasil dikonfirmasi Admin Desa", "success");

            setTimeout(function() {
                window.location.href = "../admin_data_pengajuan";
            }, 2000);
        </script>
    <?php

    }
    ?>
</body>

</html>