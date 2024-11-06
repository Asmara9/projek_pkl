<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../assets_adminlte/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="../assets_adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="../assets_adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="../assets_adminlte/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../assets_adminlte/dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../assets_adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="../assets_adminlte/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="../assets_adminlte/plugins/summernote/summernote-bs4.min.css">
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
<link rel="shortcut icon" href="<?= $logotitle; ?>">

<link rel="stylesheet" href="../assets_adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets_adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../assets_adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">