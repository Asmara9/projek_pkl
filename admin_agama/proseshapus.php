<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php
require_once '../database/config.php';
session_start();
$id = @$_GET['id'];

$queryhapusagama = mysqli_query($koneksi, "DELETE FROM tbl_agama WHERE id='$id'")or die(mysqli_error($koneksi));

    ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
               swal("Berhasil", "Data Agama dengan id : <?=$id;?> berhasil dihapus", "success");
            setTimeout(function() {
            window.location.href= "../admin_agama";
        
              }, 2000);
            
              </script>
</body>
</html>