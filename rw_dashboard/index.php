<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  session_start();
  $konstruktor = 'rw_dashboard';
  require_once '../database/config.php';
  if ($_SESSION['status'] != 1) {
    $usr = $_SESSION['username'];
    $waktu = date('Y-m-d H:i:s');
    $auth = $_SESSION['status'];
    $nama = $_SESSION['nama_user'];
    if ($auth == 2) {
      $tersangka = "Penduduk";
    }
    if ($auth == 0) {
      $tersangka = "Administrator";
    }
    if ($auth == 3) {
      $tersangka = "Rt";
    }

    $ket = "Pengguna dengan username " . $usr . " , nama_user : " . $nama . " melakukan cross authority dengan akses sebagai " . $tersangka;
    $querycrossauth = mysqli_query($koneksi, "INSERT INTO tbl_cross_auth VALUES ('','$usr','$waktu','$ket')") or die(mysqli_error($koneksi));

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

    <title><?= $namaAppBaru; ?> | Dashboard RW</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= $logoapp; ?>" alt="Monev-Skripsi" width="200">
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
        <img src="<?= $logoapp; ?>" alt="Monev-Skripsi" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $namaAppBaru; ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <?php
          include '../rw_sidebar.php';
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
              <h1 class="m-0">Dashboard RW</h1>
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
          <div class="row">
            <div class="col-sm-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <?php
                  $nik = $_SESSION['username'];

                  $pglrw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
                  $arr_rw = mysqli_fetch_assoc($pglrw);
                  ?>
                  <h4>Selamat datang <?= $_SESSION['nama_user']; ?>, Ketua RW <?= $arr_rw['rw']; ?></h4>
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
                  $kataSemangatRW = [
                    "Semangat, Ketua RW! Kepemimpinanmu menjadi kunci dalam menjaga keharmonisan antar RT di lingkungan ini.",
                    "Dengan semangat gotong royong, kamu bisa membawa perubahan positif bagi seluruh warga RW.",
                    "Setiap tantangan yang datang akan menjadikanmu pemimpin yang lebih kuat. Teruslah berjuang, Ketua RW!",
                    "Kerja kerasmu menjaga kesejahteraan warga RW sangat berarti. Tetap semangat!",
                    "Kepemimpinan yang baik akan membangun lingkungan yang solid. Teruskan perjuanganmu, Ketua RW!",
                    "Semangat kebersamaan adalah kunci keberhasilan RW ini. Terus pimpin dengan hati yang penuh dedikasi!"
                  ];
                  $pesan = $kataSemangatRW[array_rand($kataSemangatRW)]
                  ?>
                  <p><?= $pesan; ?></p>
                </div>
                <a class="small-box-footer"> <?= $tanggalIndo; ?> </a>
              </div>
            </div>
          </div>
          <!-- /.row (main row) -->

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
                          // Query Panggil rt rw
                          $pgl_rt_rw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
                          $arr_rt_rw = mysqli_fetch_assoc($pgl_rt_rw);

                          // Cek apakah data RT dan RW ada sebelum mengaksesnya
                          if ($arr_rt_rw && isset($arr_rt_rw['rw'])) {
                            $rw = $arr_rt_rw['rw'];

                            // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                            $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE rw='$rw'") or die(mysqli_error($koneksi));
                            // Ambil data hasil query
                            $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                            $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];
                          } else {
                            // Jika data tidak ditemukan, set nilai default 0
                            $jumlahPengajuanBaru = 0;
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
                          // Query Panggil rt rw
                          $pgl_rt_rw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
                          $arr_rt_rw = mysqli_fetch_assoc($pgl_rt_rw);

                          // Cek apakah data RT dan RW ada sebelum mengaksesnya
                          if ($arr_rt_rw && isset($arr_rt_rw['rw'])) {
                            $rw = $arr_rt_rw['rw'];

                            // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                            $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status = 1 AND rw='$rw'") or die(mysqli_error($koneksi));
                            // Ambil data hasil query
                            $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                            $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];
                          } else {
                            // Jika data tidak ditemukan, set nilai default 0
                            $jumlahPengajuanBaru = 0;
                          }
                          ?>
                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Belum Di ACC</p>
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
                          // Query Panggil rt rw
                          $pgl_rt_rw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
                          $arr_rt_rw = mysqli_fetch_assoc($pgl_rt_rw);

                          // Cek apakah data RT dan RW ada sebelum mengaksesnya
                          if ($arr_rt_rw && isset($arr_rt_rw['rw'])) {
                            $rw = $arr_rt_rw['rw'];

                            // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                            $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status != 1 AND rw='$rw'") or die(mysqli_error($koneksi));
                            // Ambil data hasil query
                            $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                            $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];
                          } else {
                            // Jika data tidak ditemukan, set nilai default 0
                            $jumlahPengajuanBaru = 0;
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
                          // Query Panggil rt rw
                          $pgl_rt_rw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
                          $arr_rt_rw = mysqli_fetch_assoc($pgl_rt_rw);

                          // Cek apakah data RT dan RW ada sebelum mengaksesnya
                          if ($arr_rt_rw && isset($arr_rt_rw['rw'])) {
                            $rw = $arr_rt_rw['rw'];

                            // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                            $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE rw='$rw'") or die(mysqli_error($koneksi));
                            // Ambil data hasil query
                            $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                            $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];
                          } else {
                            // Jika data tidak ditemukan, set nilai default 0
                            $jumlahPengajuanBaru = 0;
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
                          // Query Panggil rt rw
                          $pgl_rt_rw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
                          $arr_rt_rw = mysqli_fetch_assoc($pgl_rt_rw);

                          // Cek apakah data RT dan RW ada sebelum mengaksesnya
                          if ($arr_rt_rw && isset($arr_rt_rw['rw'])) {
                            $rw = $arr_rt_rw['rw'];

                            // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                            $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status = 2 AND rw='$rw'") or die(mysqli_error($koneksi));
                            // Ambil data hasil query
                            $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                            $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];
                          } else {
                            // Jika data tidak ditemukan, set nilai default 0
                            $jumlahPengajuanBaru = 0;
                          }
                          ?>

                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Belum Di ACC</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="../rw_data_pengajuan/" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12">
                      <!-- small box -->
                      <div class="small-box bg-dark">
                        <div class="inner">
                          <?php
                          $nik = @$_SESSION['username'];
                          // Query Panggil rt rw
                          $pgl_rt_rw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
                          $arr_rt_rw = mysqli_fetch_assoc($pgl_rt_rw);

                          // Cek apakah data RT dan RW ada sebelum mengaksesnya
                          if ($arr_rt_rw && isset($arr_rt_rw['rw'])) {
                            $rw = $arr_rt_rw['rw'];

                            // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
                            $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status >=3 AND rw='$rw'") or die(mysqli_error($koneksi));
                            // Ambil data hasil query
                            $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
                            $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];
                          } else {
                            // Jika data tidak ditemukan, set nilai default 0
                            $jumlahPengajuanBaru = 0;
                          }
                          ?>

                          <h4><b><?= $jumlahPengajuanBaru; ?></b></h4>
                          <p>Surat Yang Sudah ACC</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-envelope"></i>
                        </div>
                        <a href="../rw_laporan_pengajuan/" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
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