<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    session_start();
    $konstruktor = 'admin_kategori_pengantar';
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
        <title><?= $namaAppBaru; ?> | Master Data Kategori Pengantar</title>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= $logoapp; ?>" alt="MonevSkripsi">
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
                        <div class="col-lg-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Kategori Pengantar</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="">
                                    <div class="card-body">
                                        <a href="tambahkategori.php" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-plus"></i> Tambah Data</a>
                                        <a href="prosesreset.php?reset=reset_data" onclick="return confirm('Apakah Anda Yakin???')" class="btn btn-danger btn-sm"><i class="nav-icon fas fa-sync"></i> Reset</a>

                                        <button type="button" data-toggle="modal" data-target="#modal-import" class="btn btn-sm btn-success"><i class="nav-icon fas fa-file-excel"></i> Import Data</button>
                                        <table id="example1" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>
                                                        <center>ID Kategori</center>
                                                    </th>
                                                    <th>
                                                        <center>Keterangan</center>
                                                    </th>
                                                    <th>
                                                        <center>Aksi</center>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                //panggil data pada tbl_angkatan
                                                $querykategori = mysqli_query($koneksi, "SELECT * FROM tbl_kategori_pengantar") or die(mysqli_error($koneksi));

                                                //jika tabel ada isinya maka ditampilkan datanya
                                                if (mysqli_num_rows($querykategori) > 0) {
                                                    while ($dt_kategori = mysqli_fetch_array($querykategori)) {
                                                ?>
                                                        <tr>
                                                            <td width="8%">
                                                                <center><?= $no++ ?></center>
                                                            </td>
                                                            <td width="15%">
                                                                <center><?= $dt_kategori['id_kategori'] ?></center>
                                                            </td>
                                                            <td>
                                                                <?= $dt_kategori['keterangan'] ?>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <button type="button" class="btn btn-sm btn-warning btn-edit" data-toggle="modal" data-target="#modal-edit"
                                                                        data-id_kategori="<?= $dt_kategori['id_kategori']; ?>"
                                                                        data-keterangan="<?= $dt_kategori['keterangan']; ?>">
                                                                        <i class="nav-icon fas fa-edit"></i>
                                                                    </button>

                                                                    <a href="proseshapus.php?kd_kategori=<?= $dt_kategori['id_kategori']; ?>&hapus=hapus" class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data kategori dengan id kategori [<?= $dt_kategori['id_kategori']; ?>] - Keterangan : [<?= $dt_kategori['keterangan']; ?>]')"><i class="fas fa-trash"> </i>
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }
                                                // jika table tidak ada isinya maka
                                                else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="4">Tidak ditemukan data angkatan pada database</td>
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

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#001f3f;">
                <h4 class="modal-title">
                    <font color="#ffffff"><i class="fas fa-file"></i> Edit Data Kategori</font>
                </h4>
            </div>
            <form id="modal-edit" action="editkategori.php" method="POST">
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="form-group row">
                            <label for="data-id_kategori" class="col-sm-12 control-label">ID Kategori</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="id_kategori" id="id_kategori" disabled>
                                <input type="text" class="form-control" name="id_kategori" id="id_kategori" hidden>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="data-keterangan" class="col-sm-12 control-label">Keterangan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="keterangan" id="keterangan">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pull-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="editkategori" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>

<script type="text/javascript">
    $('#modal-edit').on('show.bs.modal', function(e) {
        var id_kategori = $(e.relatedTarget).data('id_kategori');
        var keterangan = $(e.relatedTarget).data('keterangan');

        $(e.currentTarget).find('input[name="id_kategori"]').val(id_kategori);
        $(e.currentTarget).find('input[name="keterangan"]').val(keterangan);
    });
</script>


</body>

</html>