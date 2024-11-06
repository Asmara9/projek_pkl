<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    session_start();
    $konstruktor = 'admin_penduduk';
    require_once '../database/config.php';

    // Memeriksa apakah user memiliki hak akses yang benar
    if ($_SESSION['status'] != 0) {
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
        if ($auth == 3) {
            $tersangka = "Rt";
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
        <title><?= $namaAppBaru; ?> | Detail Data Penduduk</title>

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
                    <?php include '../admin_sidebar.php'; ?>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Detail Data penduduk</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Detail penduduk</li>
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
                                    <h3 class="card-title"><i class="nav icon fas fa-address-card"> &nbsp Detail Data Penduduk</i></h3>
                                </div>

                                <div class="card-body">
                                    <a href="../admin_penduduk" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-chevron-left">&nbspKembali</i></a>
                                    <br>
                                    <br>
                                    <?php
                                    $kd_penduduk = @$_GET['nik'];
                                    $kodeDecript = decriptData($kd_penduduk);
                                    $querypenduduk = mysqli_query($koneksi, "SELECT * FROM tbl_penduduk WHERE nik='$kodeDecript'") or die(mysqli_error($koneksi));
                                    if (mysqli_num_rows($querypenduduk) > 0) {
                                        while ($dt_penduduk = mysqli_fetch_array($querypenduduk)) {
                                    ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <table class="table table-sm table-borderless table-striped">
                                                        <tr>
                                                            <td width="25%">
                                                                NIK
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_penduduk['nik'] ?></b>
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
                                                                <b><?= $dt_penduduk['nama'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Tempat tanggal lahir
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_penduduk['ttl'] ?></b>
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
                                                                <b><?= $dt_penduduk['rt'] ?></b>
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
                                                                <b><?= $dt_penduduk['rw'] ?></b>
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
                                                                <b><?= $dt_penduduk['jenis_kelamin'] ?></b>
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
                                                                <b><?= $dt_penduduk['alamat'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Agama
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_penduduk['agama'] ?></b>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Pekerjaan
                                                            </td>
                                                            <td width="2%">
                                                                :
                                                            </td>
                                                            <td>
                                                                <b><?= $dt_penduduk['pekerjaan'] ?></b>
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
                                                                <b><?= $dt_penduduk['no_hp'] ?></b>
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