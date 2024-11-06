<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
require_once '../database/config.php';

//trigger button gantipw
if(isset($koneksi,$_POST['gantipw'])){
    // variabel untuk menampung elemen yang dipost sesuai dengan atribut "name" nya
    $user = trim(mysqli_real_escape_string($koneksi,$_POST['user']));
    $pwlama = sha1(mysqli_real_escape_string($koneksi,$_POST['pwlama']));
    $pwbaru = sha1(mysqli_real_escape_string($koneksi,$_POST['pwbaru']));

//cek dari tabel pengguna berdasarkan value elemen $user
$querycekpw = mysqli_query($koneksi,"SELECT * FROM tbl_pengguna WHERE username='$user'") or die (mysqli_error($koneksi));

//simpan array hasil dari query diatas pada variabel $arr
$arr = mysqli_fetch_assoc($querycekpw);

// jika value dari array pada kolom password TIDAK SAMA dengan $pwlama
if($arr['password']!=$pwlama){
    
    // jika password lama tidak sesuai dengan inputan
    echo '<script>alert("Password lama tidak sesuai cik")</script>';
    echo '<script>window.location="../admin_gantipw"</script>';
}
else{
     // jika password lama sesuai dengan inputan
    $queryupdatepw = mysqli_query($koneksi,"UPDATE tbl_pengguna SET password='$pwbaru' WHERE username ='$user'") or die (mysqli_error($koneksi));
    echo '<script>alert("Password telah diubah silahkan login kembali menggunakan password baru anda..")</script>';
    echo '<script>window.location="../login/logout.php"</script>';
}

}
?>
    
</body>
</html>