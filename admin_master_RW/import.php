<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" koneksitent="width=device-width, initial-scale=1.0">
    <title>Admin Import Data</title>
</head>

<body>
    <?php
    require_once '../database/config.php';
    require '../lib/phpexcel-xls-library/vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
    session_start();
    error_reporting(0);


    //trigger post dari button name=importrw di halaman index.php
    if (isset($_POST['imporrw'])) {
        //$file merupakan variabel untuk menampung nama file yang diupload
        $file = $_FILES['file']['name'];

        //memisahkan ekstensi file yang diupload
        $ekstensi = explode(".", $file);

        //$variabel file_name untuk merename file yang diupload dengan nama file roundmicrotime (tgl+jam+mnt+dtk+md) + ekstensi
        $file_name = "file" . round(microtime(true)) . "." . end($ekstensi);

        //$sumber = mengambil nama file yang sudah diubah dengan round microtime secara temporer / temporary [temp_name]
        $sumber = $_FILES['file']['tmp_name'];

        //direktori untuk upload file
        $target_dir = "file_import/";

        //menentukan direktori file setelah diupload beserta nama file baru yang dimodifikasi
        $target_file = $target_dir . $file_name;

        //upload file ke direktori atau folder "file-import"
        $upload = move_uploaded_file($sumber, $target_file);

        //load file excel yang telah di upload
        $file_excel = PHPExcel_IOFactory::load($target_file);

        //
        $data_excel = $file_excel->getActiveSheet()->toArray(null, true, true, true);

        for ($j = 2; $j <= count($data_excel); $j++) {
            $id         = $data_excel[$j]['B'];
            $nik        = $data_excel[$j]['C'];
            $rw         = $data_excel[$j]['D'];
            $ketua      = $data_excel[$j]['E'];
            $kontak     = $data_excel[$j]['F'];
            $alamat     = $data_excel[$j]['G'];
            $pass       = sha1($nik);
            $st_pengguna = "1";

            $cekrw = mysqli_query($koneksi, "SELECT nik FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));

            $rvd = mysqli_num_rows($cekrw);
            if ($rvd > 0) {
            } else {
                $kosong = "";

                $tambahrw = mysqli_query($koneksi, "INSERT INTO tbl_rw VALUES ('', '$nik','$rw','$ketua','$kontak','$alamat')") or die(mysqli_error($koneksi));

                $hapusrwkosong = mysqli_query($koneksi, "DELETE FROM  tbl_rw WHERE nik='$kosong'") or die(mysqli_error($koneksi));

                $tambahpenggunarw = mysqli_query($koneksi, "INSERT INTO tbl_pengguna VALUES ('$nik','$pass','$ketua','$st_pengguna')") or die(mysqli_error($koneksi));

                $hapus_pg_rwkosong = mysqli_query($koneksi, "DELETE FROM tbl_pengguna WHERE username='$kosong'") or die(mysqli_error($koneksi));
            }
        }
        unlink($target_file);
    ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Berhasil", "Semua Data RW Berhasil di Import", "success");

            setTimeout(function() {
                window.location.href = "../admin_master_RW";
            }, 2000);
        </script>
    <?php
    }
    ?>
</body>

</html>