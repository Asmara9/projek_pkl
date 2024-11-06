<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    session_start();
    $konstruktor = 'rt_data_pengajuan';
    require_once '../database/config.php';

    // Memeriksa apakah user memiliki hak akses yang benar
    if ($_SESSION['status'] != 3) {
        $usr = $_SESSION['username'];
        $waktu = date('Y-m-d H:i:s');
        $auth = $_SESSION['status'];
        $nama = $_SESSION['nama_user'];
        $tersangka = "Tidak Diketahui";

        if ($auth == 0) {
            $tersangka = "Administrator";
        }
        if ($auth == 1) {
            $tersangka = "Rw";
        }
        if ($auth == 2) {
            $tersangka = "Penduduk";
        }

        $ket = "Pengguna dengan username " . $usr . " , nama : " . $nama . " melakukan cross authority dengan akses sebagai " . $tersangka;
        $querycrossauth = mysqli_query($koneksi, "INSERT INTO tbl_cross_auth VALUES ('', '$usr', '$waktu', '$ket')") or die(mysqli_error($koneksi));

        echo '<script>window.location="../login/logout.php"</script>';
    } else {
        include '../listlink.php';
    ?>
        <?php
        $pgllogoapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=1") or die(mysqli_error($koneksi));
        $arrapp = mysqli_fetch_array($pgllogoapp);
        $logoapp = $arrapp['lokasi_file'];

        $pglnamaapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=3") or die(mysqli_error($koneksi));
        $arrnamaapp = mysqli_fetch_array($pglnamaapp);
        $namaAppBaru = $arrnamaapp['elemen'];
        ?>
        <title><?= $namaAppBaru; ?> | Detail Data Pengajuan</title>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= $logoapp; ?>" alt="AdminLTELogo" width="300px">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <?php include '../navbar.php'; ?>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="<?= $logoapp; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $namaAppBaru; ?></span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <?php include '../rt_sidebar.php'; ?>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Detail Data Pengajuan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Detail Pengajuan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="nav-icon fas fa-address-card"></i> Detail Data Pengajuan</h3>
                                </div>

                                <div class="card-body">
                                    <a href="../rt_data_pengajuan" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-chevron-left"></i> Kembali</a>
                                    <br>
                                    <br>
                                    <?php
                                    $kd_penduduk = @$_GET['id_permohonan'];
                                    $kodeDecript = decriptData($kd_penduduk);
                                    $querypenduduk = mysqli_query($koneksi, "SELECT * FROM tbl_permohonan_surat WHERE id_permohonan='$kodeDecript'") or die(mysqli_error($koneksi));
                                    if (mysqli_num_rows($querypenduduk) > 0) {
                                        while ($dt_surat = mysqli_fetch_array($querypenduduk)) {
                                    ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <table class="table table-sm table-borderless table-striped">
                                                        <tr>
                                                            <td width="25%">
                                                                ID Permohonan
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['id_permohonan'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="30%">
                                                                Keterangan Pengajuan
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['id_kategori_pengantar'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Progres
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b>
                                                                    Tanggal Mengajukan - <?= $dt_surat['tgl']; ?>
                                                                    <br>
                                                                    Tanggal ACC RT - <?= $dt_surat['tgl_acc_rt']; ?>
                                                                    <br>
                                                                    Tanggal ACC RW - <?= $dt_surat['tgl_acc_rw']; ?>
                                                                    <br>
                                                                    Tanggal ACC Admin - <?= $dt_surat['tgl_acc_admin']; ?>
                                                                </b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                NIK
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['nik'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Nama Penduduk
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['nama'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Nomor RT
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['rt'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Nomor RW
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['rw'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Jenis Kelamin
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['jenis_kelamin'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Alamat
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['alamat'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                No HP
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['no_hp'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Keterangan
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_surat['keterangan']; ?></b>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            <?php
                                        }
                                    } else {
                                            ?>
                                            <div class="alert alert-danger">
                                                Tidak ditemukan data penduduk pada database.
                                            </div>
                                        <?php
                                    }
                                        ?>
                                            </div> <!-- /.row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include '../footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

<?php include '../script.php';
    } ?>

</body>

</html>