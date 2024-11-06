<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    session_start();
    $konstruktor = 'profil_penduduk';
    require_once '../database/config.php';
    if ($_SESSION['status'] != 2) {
        $usr = $_SESSION['username'];
        $waktu = date('Y-m-d H:i:s');
        $auth = $_SESSION['status'];
        $nama = $_SESSION['nama_user'];
        if ($auth == 1) {
            $tersangka = "Rw";
        }
        if ($auth == 3) {
            $tersangka = "Rt";
        }
        if ($auth == 0) {
            $tersangka = "Administrator";
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
        <title><?= $namaAppBaru; ?> | Profil Penduduk</title>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= $logoapp; ?>" alt="AdminLTELogo" width="200">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <?php
            include '../navbar.php';
            ?>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?= $logoapp; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $namaAppBaru; ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <?php
                    include '../penduduk_sidebar.php';
                    ?>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Profil Penduduk</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Profil Penduduk</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="nav-icon fas fa-user"></i> Profil Penduduk</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="prosestambah.php" method="post">
                                    <?php
                                    $nik = @$_SESSION['username'];
                                    $querypenduduk = mysqli_query($koneksi, "SELECT * FROM tbl_penduduk WHERE nik='$nik'") or die(mysqli_error($koneksi));
                                    if (mysqli_num_rows($querypenduduk) > 0) {
                                        while ($dt_penduduk = mysqli_fetch_array($querypenduduk)) {
                                    ?>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="nik">NIK</label>
                                                    <input type="text" class="form-control" maxlength="20" id="nik" name="nik" placeholder="Input NIK Penduduk" value="<?= $dt_penduduk['nik']; ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" maxlength="100" id="nama" name="nama" value="<?= $dt_penduduk['nama']; ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                    <input type="text" class="form-control" maxlength="100" id="nama" name="nama" value="<?= $dt_penduduk['jenis_kelamin']; ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Nomor RT</label>
                                                    <input type="text" class="form-control" maxlength="100" id="nama" name="nama" value="<?= $dt_penduduk['rt']; ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rw">Nomor RW</label>
                                                    <input type="text" class="form-control" maxlength="100" id="nama" name="nama" value="<?= $dt_penduduk['rw']; ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" class="form-control" maxlength="200" id="alamat" name="alamat" value="<?= $dt_penduduk['alamat']; ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">NO HP</label>
                                                    <input type="text" class="form-control" maxlength="15" id="no_hp" name="no_hp" value="<?= $dt_penduduk['no_hp']; ?>" disabled>
                                                </div>
                                                <!-- <div class="card-footer" style="float: right;">
                                            <a href="../admin_penduduk" class="btn btn-warning"><i class="nav-icon fas fa-chevron-left">&nbspKembali</i></a>
                                            <button type="submit" class="btn btn-primary" name="tambah"><i class="nav-icon fas fa-plus">&nbsp Tambahkan</i></button>
                                        </div> -->
                                </form>
                        <?php
                                        }
                                    }
                        ?>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php

        include '../footer.php';

    ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
<?php
        include '../script.php';
    }
?>
</body>

</html>