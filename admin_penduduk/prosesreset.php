<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Reset Data penduduk</title>
</head>
<body>
    <?php
    require_once '../database/config.php';
    session_start();

    $ambilnikpenduduk = mysqli_query($koneksi, "SELECT nik FROM tbl_penduduk") or die (mysqli_error($koneksi));
    $rvambilnikpenduduk = mysqli_num_rows($ambilnikpenduduk);
    if ($rvambilnikpenduduk==0){
    ?>
    <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal("Data Kosong", "Data penduduk Kosong", "info");
    setTimeout(function(){
        window.location.href = "../admin_penduduk";
    }, 1500);
    </script>
    <?php
    }
    else{
        while($data=mysqli_fetch_assoc($ambilnikpenduduk)){
            $nik = $data['nik'];
      
            $queryhapus_pg_penduduk =mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$nik'")or die (mysqli_error($koneksi));
        }
            $queryhapus_penduduk=mysqli_query($koneksi, "TRUNCATE TABLE tbl_penduduk")or die (mysqli_error($koneksi));
       
      
    }
    ?>
     <script src="https:unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    swal("Berhasil", "Data penduduk Berhasil di Reset", "success");
    setTimeout(function(){
        window.location.href = "../admin_penduduk";
    }, 1500);
    </script>
      
</body>
</html>