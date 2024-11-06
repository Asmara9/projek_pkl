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
<footer class="main-footer">
  <strong>Copyright &copy; <?php echo date('Y') ?> <?= $namaCopyright; ?> <a href="#"><?= $namaDesa ?></a> </strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
  </div>
</footer>