<?php
require_once '../database/config.php';
session_start();

?>
<?php
$pgllogoapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=1") or die(mysqli_error($koneksi));
$arrapp = mysqli_fetch_array($pgllogoapp);
$logoapp = $arrapp['lokasi_file'];

$pgllogotitle = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=2") or die(mysqli_error($koneksi));
$arrtitle = mysqli_fetch_array($pgllogotitle);
$logotitle = $arrtitle['lokasi_file'];
?>
<?php
$pglnamaapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=3") or die(mysqli_error($koneksi));
$arrnamaapp = mysqli_fetch_array($pglnamaapp);
$namaAppBaru = $arrnamaapp['elemen'];
?>

<?php
$pglcopyright = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=4") or die(mysqli_error($koneksi));
$arrcopyright = mysqli_fetch_array($pglcopyright);
$namaCopyright = $arrcopyright['elemen'];
?>

<?php
$pglDesa = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=5") or die(mysqli_error($koneksi));
$arrDesa = mysqli_fetch_array($pglDesa);
$namaDesa = $arrDesa['elemen'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $namaAppBaru; ?> | Log in</title>
  <link rel="shortcut icon" href="<?= $logotitle; ?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets_adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../assets_adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets_adminlte/dist/css/adminlte.min.css">

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <center>
      <img src="<?= $logoapp ?>" alt="logoapp" width="200px">
    </center>
    <div class="login-logo">
      <h5><a href="../login"><b> <?= $namaAppBaru; ?></b></a></h5>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="NIM / NIDN" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-circle"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="pass">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <a href="#" class="btn btn-block btn-danger">
                <i class="nav-icon fas fa-question-circle"></i> Lupa Password
              </a>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block" name="login">Log In <i class="nav-icon fas fa-sign-out-alt"></i></button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <?php

        //tangkap trigger button "login"
        if (isset($koneksi, $_POST['login'])) {

          //menyimpan value pada elemen username dan pass ke dalam variabel $user dan $pwd
          $user = trim(mysqli_escape_string($koneksi, $_POST['username']));
          $pwd = sha1(trim(mysqli_real_escape_string($koneksi, $_POST['pass'])));

          //cek user pada database
          $querycek = mysqli_query($koneksi, "SELECT * FROM tbl_pengguna WHERE username='$user' AND password='$pwd'") or die(mysqli_error($koneksi));

          //cek apakah ada value yang dikembalikan oleh query, jika value=1 maka terdapat user seperti value elemen yang diinput user,jika 0 sebaliknya
          $rv = mysqli_num_rows($querycek);

          //buat percabangan dari hasil retrun value
          if ($rv == 1) {
            //jika hasil $rv = 1 (ada user yang dimaksud)

            //buat variabel untuk menampung value dari $querycek
            $array = mysqli_fetch_assoc($querycek);

            //buat variabel untuk menampung nilai tertentu dari array yang diambil lewat query
            $st_user = $array['status'];

            //buat nested if (percabangan didalam percabangan)
            if ($st_user == 0) {
              $_SESSION['username'] = $user;
              $_SESSION['nama_user'] = $array['nama_user'];
              $_SESSION['status'] = $st_user;

              echo '<script>
                window.location="../admin_dashboard"</script>';
            } elseif ($st_user == 1) {
              $_SESSION['username'] = $user;
              $_SESSION['nama_user'] = $array['nama_user'];
              $_SESSION['status'] = $st_user;

              echo '<script>
                window.location="../rw_dashboard"</script>';
            } elseif ($st_user == 2) {
              $_SESSION['username'] = $user;
              $_SESSION['nama_user'] = $array['nama_user'];
              $_SESSION['status'] = $st_user;

              echo '<script>
                window.location="../penduduk_dashboard"</script>';
            } elseif ($st_user == 3) {
              $_SESSION['username'] = $user;
              $_SESSION['nama_user'] = $array['nama_user'];
              $_SESSION['status'] = $st_user;

              echo '<script>
                window.location="../rt_dashboard"</script>';
            }
          } else {
            //jika hasil $rv = 0 (tidak ada user yang dimaksud)
            session_destroy();
            echo '<script>
                window.location="../gagal_login"</script>';
          }
        }

        ?>

        <div>
          <br>
          <center>
            Copyright &copy; <?= $namaCopyright; ?>
            <br> <b> <?= $namaDesa ?></b>
            <br> <?php echo date('Y') ?>
          </center>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../assets_adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets_adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets_adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>