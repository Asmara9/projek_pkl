<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  session_start();
  $konstruktor = 'konfigurasi_sistem';
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
    if ($auth == 3) {
      $tersangka = "Rt";
    }

    $ket = "pengguna dengan username " . $usr . " , nama : " . $nama . " melakukan cross authority dengan akses sebagai " . $tersangka;
    $querycrossauth = mysqli_query($koneksi, "INSERT INTO tbl_cros_auth VALUES ('', '$usr', '$waktu', '$ket') ") or die(mysqli_error($koneksi));

    echo '<script>window.location="../login/logout.php"</script>';
  } else {
    include '../listlink.php';
  ?>
    <?php
    $pglnamaapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=3") or die(mysqli_error($koneksi));
    $arrnamaapp = mysqli_fetch_array($pglnamaapp);
    $namaAppBaru = $arrnamaapp['elemen'];
    ?>
    <title><?= $namaAppBaru; ?> | Dashboard Konfigurasi Sistem</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    $pgllogoapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=1") or die(mysqli_error($koneksi));
    $arrapp = mysqli_fetch_array($pgllogoapp);
    $logoapp = $arrapp['lokasi_file'];

    $pgllogotitle = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=2") or die(mysqli_error($koneksi));
    $arrtitle = mysqli_fetch_array($pgllogotitle);
    $logotitle = $arrtitle['lokasi_file'];

    ?>
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= $logoapp; ?>" alt=" Monev-Skripsi" width="200">
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
      <a href="" class="brand-link">
        <img src="<?= $logoapp; ?>" alt="Monev-Skripsi" class="brand-image img-circle elevation-3" style="opacity: .8">
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
              <h1 class="m-0">Konfigurasi Sistem</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Konfigurasi Sistem</li>
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
            <div class="col-lg-12">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="nav-icon fas fa-cog">&nbsp</i>Konfigurasi Sistem </h3>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"><i class="nav-icon fas fa-image"></i> Logo Aplikasi</h3>
                        </div>
                        <div class="card-body">
                          <form action="updatelogoapp.php" method="post" enctype="multipart/form-data">
                            <center>
                              <img src="<?= $logoapp; ?>" height="125px" width="125px">
                            </center>
                            <br>
                            <br>
                            <br>
                            <br>
                            <input type="file" name="logoapp" class="form-control" accept="image/*" required>
                            direkomendasikan menggunakan file (xxx.png)
                            </br>
                            </br>
                            <button type="submit" class="btn btn-success btn-sm btn-block" name="updlogoapp"><i class="nav-icon fas fa-upload"></i> Update logo app</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"><i class="nav-icon fas fa-image"></i> Logo Title </h3>
                        </div>
                        <div class="card-body">
                          <form action="updatelogotitle.php" method="post" enctype="multipart/form-data">
                            <center>
                              <img src="<?= $logotitle; ?>" height="125px" width="125px">
                            </center>
                            <br>
                            <br>
                            <br>
                            <br>
                            <input type="file" name="logotitle" class="form-control" accept="image/*" required>
                            direkomendasikan menggunakan file (xxx.png)
                            </br>
                            </br>
                            <button type="submit" class="btn btn-success btn-sm btn-block" name="updtitle"><i class="nav-icon fas fa-upload"></i> Update logo title</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"><i class="nav-icon fas fa-cog"></i> Konfigurasi Nama Aplikasi </h3>
                        </div>
                        <div class="card-body">
                          <form action="updatenama.php" method="POST">
                            <div class="row">
                              <div class="col-lg-2">
                                <label for="nama-app">
                                  Nama Aplikasi
                                </label>
                              </div>
                              <div class="col-lg-8">
                                <input type="text" name="appname"
                                  class="form-control" placeholder="Masukkan Nama Aplikasi" required>
                              </div>
                              <div class="col-lg-2">
                                <button type="submit" class="btn-sm btn-block btn-success" name="gantinama">
                                  Ganti
                                </button>
                          </form>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="nav-icon fas fa-cog"></i> Konfigurasi Copyright Aplikasi </h3>
                    </div>
                    <div class="card-body">
                      <form action="updatecopy.php" method="POST">
                        <div class="row">
                          <div class="col-lg-2">
                            <label for="copyright">
                              Copyright
                            </label>
                          </div>
                          <div class="col-lg-8">
                            <input type="text" name="copyright"
                              class="form-control" placeholder="Masukkan Nama Copyright" required>
                          </div>
                          <div class="col-lg-2">
                            <button type="submit" class="btn-sm btn-block btn-success" name="updatecopy">
                              Ganti
                            </button>
                      </form>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="nav-icon fas fa-cog"></i> Konfigurasi Nama Desa </h3>
                </div>
                <div class="card-body">
                  <form action="updatedesa.php" method="POST">
                    <div class="row">
                      <div class="col-lg-2">
                        <label for="desa">
                          Desa
                        </label>
                      </div>
                      <div class="col-lg-8">
                        <input type="text" name="desa"
                          class="form-control" placeholder="Masukkan Nama Desa" required>

                      </div>
                      <div class="col-lg-2">
                        <button type="submit" class="btn-sm btn-block btn-success" name="updatedesa">
                          Ganti
                        </button>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
  </div>
  </div>




  </div>
  <!-- /.card-body -->

  </form>
  </div>
  <!-- /.card -->
  </div>

  <!-- //yg baru -->


  </div>
  <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
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

  <!-- jQuery -->
<?php
    include '../script.php';
  }
?>
</body>

</html>