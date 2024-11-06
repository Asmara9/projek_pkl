<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  session_start();
  $konstruktor = 'admin_penduduk';
  require_once '../database/config.php';
  if ($_SESSION['status'] != 0) {
    $usr = $_SESSION['username'];
    $waktu = date('Y-m-d H:i:s');
    $auth = $_SESSION['status'];
    $nama = $_SESSION['nama_user'];
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
    <title><?= $namaAppBaru; ?> | Tambah Penduduk</title>

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
          include '../admin_sidebar.php';
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
              <h1 class="m-0">Dashboard Data Penduduk</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tambah Penduduk</li>
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
                  <h3 class="card-title"><i class="nav-icon fas fa-plus"></i> Tambah Penduduk</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="prosestambah.php" method="post">
                  <div class="card-body">
                    <a href="../admin_penduduk" class="btn btn-warning btn-sm"><i class="nav-icon fas fa-chevron-left"></i> Kembali</a>
                    <br>
                    <br>
                    <div class="form-group">
                      <label for="nik">NIK</label>
                      <input type="text" class="form-control" maxlength="20" id="nik" name="nik" placeholder="Input NIK Penduduk" onkeypress="return IsNumeric(event);" autofocus required>
                    </div>
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" maxlength="100" id="nama" name="nama" placeholder="Input Nama Penduduk" required>
                    </div>
                    <div class="form-group">
                      <label for="ttl">Tempat Tanggal Lahir</label>
                      <input type="text" class="form-control" maxlength="100" id="ttl" name="ttl" placeholder="Input Tempat Tanggal Lahir" required>
                    </div>
                    <div class="form-group">
                      <label for="jenis_kelamin">Jenis Kelamin</label>
                      <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="">-- Pilih Kelamin ---</option>
                        <option value="Laki-laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="jenis_kelamin">Nomor RT</label>
                      <select class="form-control" name="rt" id="rt" required>
                        <option value="">-- Pilih Nomor RT ---</option>
                        <?php
                        $pglrt = mysqli_query($koneksi, "SELECT * FROM tbl_rt") or die(mysqli_error($koneksi));
                        $rvrt = mysqli_num_rows($pglrt);
                        if ($rvrt > 0) {
                          while ($dt_rt = mysqli_fetch_array($pglrt)) {
                        ?>
                            <option value="<?= $dt_rt['rt']; ?>"> RT <?= $dt_rt['rt']; ?> - <?= $dt_rt['ketua']; ?> - RW <?= $dt_rt['rw']; ?></option>
                        <?php
                          }
                        } else {
                          // Data Kosong
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="rw">Nomor RW</label>
                      <select class="form-control" name="rw" id="rw" required>
                        <option value="">-- Pilih Nomor RW ---</option>
                        <?php
                        $pglrw = mysqli_query($koneksi, "SELECT * FROM tbl_rw") or die(mysqli_error($koneksi));
                        $rvrw = mysqli_num_rows($pglrw);
                        if ($rvrw > 0) {
                          while ($dt_rw = mysqli_fetch_array($pglrw)) {
                        ?>
                            <option value="<?= $dt_rw['rw']; ?>"><?= $dt_rw['rw']; ?> - <?= $dt_rw['ketua']; ?></option>
                        <?php
                          }
                        } else {
                          // Data Kosong
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat</label>
                      <input type="text" class="form-control" maxlength="200" id="alamat" name="alamat" placeholder="Input Alamat Penduduk" required>
                    </div>
                    <div class="form-group row">
                      <label for="agama" class="col-sm-12 control-label">Agama</label>
                      <select class="form-control" name="agama" id="agama" required>
                        <option value="">-- Pilih Agama ---</option>
                        <?php
                        $pglagama = mysqli_query($koneksi, "SELECT * FROM tbl_agama") or die(mysqli_error($koneksi));
                        $rvagama = mysqli_num_rows($pglagama);
                        if ($rvagama > 0) {
                          while ($dt_agama = mysqli_fetch_array($pglagama)) {
                        ?>
                            <option value="<?= $dt_agama['agama']; ?>"> <?= $dt_agama['id']; ?> - <?= $dt_agama['agama']; ?></option>
                        <?php
                          }
                        } else {
                          // Data Kosong
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pekerjaan">Pekerjaan</label>
                      <input type="text" class="form-control" maxlength="15" id="pekerjaan" name="pekerjaan" placeholder="Input Pekerjaan" required>
                    </div>
                    <div class="form-group">
                      <label for="no_hp">NO HP</label>
                      <input type="text" class="form-control" maxlength="15" id="no_hp" name="no_hp" placeholder="Input Kontak Penduduk" required>
                    </div>

                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block" name="tambahpenduduk"><i class="nav-icon fas fa-plus"></i> Tambah</button>
                  </div>
                </form>
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
<span id="error" style="color: red; display: none">* Input digits (0 - 9)</span>
<script type="text/javascript">
  var specialKeys = new Array();
  specialKeys.push(8); //Backspace
  function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    document.getElementById("error").style.display = ret ? "none" : "inline";
    return ret;
  }
</script>
</body>

</html>