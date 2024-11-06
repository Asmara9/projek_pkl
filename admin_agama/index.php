<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    session_start();
    $konstruktor = 'admin_agama';
    require_once '../database/config.php';
    if ($_SESSION['status'] != 0) {
        $user = $_SESSION['username'];
        $waktu = date('Y-m-d H:i:s');
        $auth = $_SESSION['status'];
        $nama = $_SESSION['nama_user'];
        if ($auth == 1) {
            $tersangka = "Rw";
        }
        if ($auth == 2) {
            $tersangka = "Penduduk";
        }
        // if ($auth > 2) {
        //     $tersangka = "Unknown";
        // }
        $keterangan = "Pengguna dengan username " . $user . ", nama: " . $nama . " Melakukan cross authority ke Admin dengan akses sebagai " . $tersangka;
        $querycrossauth = mysqli_query($koneksi, "INSERT INTO tbl_cross_auth VALUES ('','$user','$waktu','$keterangan')") or die(mysqli_error($koneksi));

        echo '<script>window.location="../login/logout.php"</script>';
    } else {


        include '../listlink.php'
    ?>
        <?php
        $pgllogoapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=1") or die(mysqli_error($koneksi));
        $arrapp = mysqli_fetch_array($pgllogoapp);
        $logoapp = $arrapp['lokasi_file'];

        $pglnamaapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=3") or die(mysqli_error($koneksi));
        $arrnamaapp = mysqli_fetch_array($pglnamaapp);
        $namaAppBaru = $arrnamaapp['elemen'];
        ?>
        <title><?= $namaAppBaru; ?> | Master Data Agama</title>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= $logoapp; ?>" alt="sigap">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <?php
            include '../navbar.php'
            ?>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?= $logoapp; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $namaAppBaru; ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <?php
                    include '../admin_sidebar.php'
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

                        </div><!-- /.col -->
                        <div class="col-sm-6">

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
                                    <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> AGAMA</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="proses.php" method="">
                                    <div class="card-body">
                                        <a href="tambahagama.php" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-plus"></i> Tambah Data</a>
                                        <a href="prosesreset.php?reset=reset_data" onclick="return confirm('Apakah Anda Yakin???')" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-sync"></i> Reset</a>

                                        <table id="example1" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th width="10%">
                                                        <center>No</center>
                                                    </th>
                                                    <th width="10%">
                                                        <center>ID</center>
                                                    </th>
                                                    <th>
                                                        <center>Agama</center>
                                                    </th>
                                                    <th>
                                                        <center>Aksi</center>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $queryagama = mysqli_query($koneksi, "SELECT * FROM tbl_agama") or die(mysqli_error($koneksi));

                                                if (mysqli_num_rows($queryagama) > 0) {
                                                    while ($dt_agama = mysqli_fetch_array($queryagama)) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <center><?= $no++; ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?= $dt_agama['id']; ?></center>
                                                            </td>
                                                            <td>
                                                                <center><?= $dt_agama['agama']; ?></center>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <a href="proseshapus.php?id=<?= $dt_agama['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data agama dengan id : [<?= $dt_agama['id']; ?>] - agama : [<?= $dt_agama['agama']; ?>]')"><i class="nav-icon fas fa-trash"></i></a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="4"> Tidak ditemukan data prodi pada database</td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </form>
                            </div>
                        </div>
                        <!-- right col -->
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
        include '../footer.php'
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