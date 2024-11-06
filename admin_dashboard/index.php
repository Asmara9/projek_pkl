<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  session_start();
  $konstruktor = 'admin_dashboard';
  require_once '../database/config.php';
  if ($_SESSION['status'] != 0) {
    $usr = $_SESSION['username'];
    $waktu = date('Y-m-d H:i:s');
    $auth = $_SESSION['status'];
    $nama = $_SESSION['nama_user'];
    if ($auth == 1) {
      $tersangka = "RW";
    }
    if ($auth == 2) {
      $tersangka = "Penduduk";
    }

    $ket = "Pengguna dengan username " . $usr . " , nama : " . $nama . " melakukan cross authority dengan akses sebagai " . $tersangka;
    $querycrossauth = mysqli_query($koneksi, "INSERT INTO tbl_cross_auth VALUES ('','$usr','$waktu','$ket')") or die(mysqli_error($koneksi));

    echo '<script>window.location="../login/logout.php"</script>';
  } else {
    include '../listlink.php';

    $pgllogoapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=1") or die(mysqli_error($koneksi));
    $arrapp = mysqli_fetch_array($pgllogoapp);
    $logoapp = $arrapp['lokasi_file'];

    $pglnamaapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=3") or die(mysqli_error($koneksi));
    $arrnamaapp = mysqli_fetch_array($pglnamaapp);
    $namaAppBaru = $arrnamaapp['elemen'];

  ?>
    <title><?= $namaAppBaru; ?> | Dashboard Admin</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../img/desa.png" alt="AdminLTELogo" width="200">
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
      <a href="#" class="brand-link">
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
              <h1 class="m-0">Dashboard Administrator</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
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
          <!-- <div class="row">
            <div class="col-lg-12">
              <div class="card card-body">
                <?php
                $value = 'Candrasa Asmaradanta';
                $encript_data = encriptData($value);
                $decript_data = decriptData($encript_data);
                // echo $value;
                // echo '<hr>';
                echo $encript_data;
                // echo '<hr>';
                // echo $decript_data;
                ?>
              </div>
            </div>
          </div> -->

          <div class="row">
            <div class="col-sm-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h4>Selamat datang <?= $_SESSION['nama_user']; ?></h4>
                  <?php
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
                  // Array berisi kata-kata semangat
                  $kataSemangat = [
                    "Teruslah berjuang, Admin Desa! Setiap langkah yang kamu ambil membawa perubahan besar.",
                    "Semangat melayani dan membangun, karena desa ini tumbuh bersama kerja kerasmu!",
                    "Kerja keras hari ini adalah masa depan yang lebih baik bagi desa esok hari. Teruskan perjuanganmu!",
                    "Tak ada usaha yang sia-sia. Dedikasimu membuat desa semakin maju. Semangat terus, Admin Desa!",
                    "Setiap masalah adalah tantangan yang mendewasakan. Tetap kuat, tetap semangat, Admin Desa!",
                    "Dedikasimu adalah kunci kemajuan. Teruslah melayani dengan sepenuh hati, karena desa ini membutuhkanmu!"
                  ];

                  // Pilih secara acak salah satu pesan dari array
                  $pesanMotivasi = $kataSemangat[array_rand($kataSemangat)];
                  ?>
                  <p><?= $pesanMotivasi; ?></p>
                </div>
                <a class="small-box-footer"> <?= $tanggalIndo; ?> </a>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="nav-icon fas fa-chart-bar"></i> Progres RT</h3>
                    </div>
                    <br>
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-primary">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Masuk</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-primary">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status = 1") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Belum Di ACC</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="surat_belum_acc_rt.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-primary">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status != 1") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Yang Sudah ACC</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="card card-dark">
                    <div class="card-header">
                      <h3 class="card-title"><i class="nav-icon fas fa-chart-bar"></i> Progres RW</h3>
                    </div>
                    <br>
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-dark">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Masuk</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-dark">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status = 2") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Belum Di ACC</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="surat_belum_acc_rw.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-dark">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status >=3") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Yang Sudah ACC</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title"><i class="nav-icon fas fa-chart-bar"></i> Progres Admin</h3>
                    </div>
                    <br>
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Masuk</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status =3 ") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Belum Di ACC</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="../admin_data_pengajuan/" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-success">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                          $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status = 4") or die(mysqli_error($koneksi));
                          // Ambil data hasil query
                          $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                          $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];

                          // Cek apakah jumlah pengajuan 0
                          if ($jumlahPengajuanBaru == 0) {
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Yang Sudah ACC</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="../admin_laporan_pengajuan/" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                  </div>
                </div>
              </div>
              <!-- /.row (main row) -->
            </div>
          </div>
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

  <!-- jQuery -->
<?php
    include '../script.php';
  }
?>
</body>

</html>