<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
  session_start();
  $konstruktor = 'rw_data_pengajuan';
  require_once '../database/config.php';
  if ($_SESSION['status'] != 1) {
    $usr = $_SESSION['username'];
    $waktu = date('Y-m-d H:i:s');
    $auth = $_SESSION['status'];
    $nama = $_SESSION['nama_user'];
    if ($auth == 0) {
      $tersangka = "Administrator";
    }
    if ($auth == 3) {
      $tersangka = "Rt";
    }
    if ($auth == 2) {
      $tersangka = "Penduduk";
    }

    $ket = "Pengguna dengan username " . $usr . " , nama : " . $nama . " melakukan cross authority dengan akses sebagai " . $tersangka;
    $querycrossauth = mysqli_query($koneksi, "INSERT INTO tbl_cross_auth VALUES ('','$usr','$waktu','$ket')") or die(mysqli_error($koneksi));

    echo '<script>window.location="../login/logout.php"</script>';
  } else {
    include '../listlink.php';
  ?><?php
    $pgllogoapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=1") or die(mysqli_error($koneksi));
    $arrapp = mysqli_fetch_array($pgllogoapp);
    $logoapp = $arrapp['lokasi_file'];

    $pglnamaapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=3") or die(mysqli_error($koneksi));
    $arrnamaapp = mysqli_fetch_array($pglnamaapp);
    $namaAppBaru = $arrnamaapp['elemen'];
    ?>
  <title><?= $namaAppBaru; ?> | Dashboard Data Pengajuan</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?= $logoapp; ?>" alt="AdminLTELogo" width="200">
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
              <h1 class="m-0">Master Data Pengajuan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Master Data Pengajuan</li>
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
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title"><i class="nav-icon fas fa-list"></i> Data Pengajuan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                  <!-- <a href="tambahpenduduk.php" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-download"></i> Tambah Data</a>
                  <button type="button" data-toggle="modal" data-target="#modal-import" class="btn btn-sm btn-success"><i class="nav-icon fas fa-file-excel"></i> Import Data</button> -->
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>
                          <center>Nama</center>
                        </th>
                        <th>
                          <center>Tanggal Pengajuan</center>
                        </th>
                        <th>
                          <center>RT/RW</center>
                        </th>
                        <th>
                          <center>Kategori</center>
                        </th>
                        <th>
                          <center>No HP</center>
                        </th>
                        <th>
                          <center>Status</center>
                        </th>
                        <th>
                          <center>Aksi</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $nik = @$_SESSION['username'];
                      $rt_rw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
                      $arr_rt_rw = mysqli_fetch_assoc($rt_rw);
                      $rw = $arr_rt_rw['rw'];
                      //panggil data status pengajuan
                      $querypenduduk = mysqli_query($koneksi, "SELECT * FROM tbl_permohonan_surat WHERE rw='$rw' AND status=2 ORDER BY tgl, tgl_acc_rt, tgl_acc_rw, tgl_acc_admin DESC") or die(mysqli_error($koneksi));
                      //jika tabel ada isinya maka ditampilkan datanya
                      if (mysqli_num_rows($querypenduduk) > 0) {
                        while ($dt_surat = mysqli_fetch_array($querypenduduk)) {
                      ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td>
                              <b><?= $dt_surat['nik'] ?></b>
                              <br>
                              <?= $dt_surat['nama'] ?>
                            </td>
                            <td>
                              <center>
                                <?= $dt_surat['tgl']; ?>
                              </center>
                            </td>
                            <td>
                              <center>
                                <?= $dt_surat['rt'] ?>/<?= $dt_surat['rw'] ?>
                              </center>
                            </td>
                            <td><?= $dt_surat['id_kategori_pengantar'] ?></td>
                            <td>
                              <center>
                                <?php
                                // Asumsikan $dt_surat['kontak'] adalah nomor telepon yang disimpan di database
                                $kontak = $dt_surat['no_hp'];
                                // Hapus karakter non-numerik dari nomor telepon
                                $kontak = preg_replace('/\D/', '', $kontak);
                                // Ganti awalan 0 dengan 62
                                if (substr($kontak, 0, 1) == '0') {
                                  $kontak = '62' . substr($kontak, 1);
                                }
                                ?>
                                <a href="https://api.whatsapp.com/send?phone=<?= $kontak; ?>&text=Halooo" class="btn btn-sm btn-success" target="_blank">
                                  <img src="../img/wa.png" alt="logo wa" height="18px" width="18px">
                                </a>
                              </center>
                            </td>
                            <td>
                              <?php
                              $st_surat = $dt_surat['status'];
                              $qr_status = mysqli_query($koneksi, "SELECT keterangan FROM tbl_status WHERE id_status='$st_surat'") or die(mysqli_error($koneksi));
                              $dt_status = mysqli_fetch_assoc($qr_status);
                              $ket = $dt_status['keterangan'];
                              ?>
                              <center>
                                <button class="btn btn-sm btn-warning"> <?= $ket; ?>
                                </button>
                              </center>
                            </td>

                            <td>
                              <center>
                                <!-- Edit -->
                                <!-- <button type="button" class="btn btn-sm btn-warning btn-edit" data-toggle="modal" data-target="#modal-edit"
                                  data-nik="<?= $dt_surat['nik']; ?>"
                                  data-nama="<?= $dt_surat['nama']; ?>"
                                  data-rt="<?= $dt_surat['rt']; ?>"
                                  data-rw="<?= $dt_surat['rw']; ?>"
                                  data-jenis_kelamin="<?= $dt_surat['jenis_kelamin']; ?>"
                                  data-alamat="<?= $dt_surat['alamat']; ?>"
                                  data-no_hp="<?= $dt_surat['no_hp']; ?>">
                                  <i class="nav-icon fas fa-edit"></i>
                                </button> -->
                                <!-- ACC -->
                                <a href="proses_acc.php?kd_status=<?= encriptData($dt_surat['id_permohonan']) ?>&acc=acc" class="btn btn-sm btn-success"><i class="fas fa-check"> </i></a>
                                <!-- Eksport -->
                                <a href="eksporpdf.php" class="btn btn-danger btn-sm" target="_blank"><i class="nav-icon fas fa-file-pdf"></i>
                                </a>
                                <!-- Detail -->
                                <a href="detailpengajuan.php?id_permohonan=<?= encriptData($dt_surat['id_permohonan']); ?>" class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i></a>
                              </center>
                            </td>
                          </tr>
                        <?php
                        }
                      }
                      // jika table tidak ada isinya maka
                      else {
                        ?>
                        <tr>
                          <td colspan="8">Tidak ditemukan data pengajuan pada database</td>
                        </tr>
                      <?php
                      }

                      ?>
                    </tbody>

                  </table>

                </div>
                <!-- /.card-body -->

              </div>
            </div>
          </div>
          <!-- /.row (main row) -->
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

<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color: blue;">
        <h4 class="modal-title">
          <font color="#ffffff"><i class="fas fa-file"></i> Edit Data Penduduk</font>
        </h4>
      </div>
      <form id="#modal-edit" action="editpenduduk.php" method="POST">
        <div class="modal-body">
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="form-group row">
                  <label for="data-nik" class="col-sm-12 control-label">nik</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="nik" id="nik" disabled>
                    <input type="text" class="form-control" name="nik" id="nik" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-nama" class="col-sm-12 control-label">Nama Penduduk</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="nama" id="nama">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-nama" class="col-sm-12 control-label">Nomor RT</label>
                  <select class="form-control" name="rt" id="rt" required>
                    <option value="">-- Pilih Nomor RT ---</option>
                    <?php
                    $pglrt = mysqli_query($koneksi, "SELECT * FROM tbl_rt") or die(mysqli_error($koneksi));
                    $rvrt = mysqli_num_rows($pglrt);
                    if ($rvrt > 0) {
                      while ($dt_rt = mysqli_fetch_array($pglrt)) {
                    ?>
                        <option value="<?= $dt_rt['rt']; ?>"> <?= $dt_rt['id']; ?> - <?= $dt_rt['rt']; ?></option>
                    <?php
                      }
                    } else {
                      // Data Kosong
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group row">
                  <label for="data-nama" class="col-sm-12 control-label">Nomor RT</label>
                  <select class="form-control" name="rw" id="rw" required>
                    <option value="">-- Pilih Nomor RW ---</option>
                    <?php
                    $pglrw = mysqli_query($koneksi, "SELECT * FROM tbl_rw") or die(mysqli_error($koneksi));
                    $rvrw = mysqli_num_rows($pglrw);
                    if ($rvrw > 0) {
                      while ($dt_rw = mysqli_fetch_array($pglrw)) {
                    ?>
                        <option value="<?= $dt_rw['rw']; ?>"> <?= $dt_rw['id']; ?> - <?= $dt_rw['rw']; ?></option>
                    <?php
                      }
                    } else {
                      // Data Kosong
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group row">
                  <label for="data-jenis_kelamin" class="col-sm-12 control-label">Jenis Kelamin</label>
                  <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="">-- Pilih Kelamin ---</option>
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="form-group row">
                  <label for="data-alamat" class="col-sm-12 control-label">Alamat</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="alamat" id="alamat">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-nohp" class="col-sm-12 control-label">NO HP</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="no_hp" id="no_hp">
                  </div>
                </div>

              </div>
              </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" name="editpenduduk" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </div>
    </div>
    </form>
  </div>
</div>
</div>

<script type="text/javascript">
  $('#modal-edit').on('show.bs.modal', function(e) {

    var nik = $(e.relatedTarget).data('nik');
    var nama = $(e.relatedTarget).data('nama');
    var rt = $(e.relatedTarget).data('rt');
    var rw = $(e.relatedTarget).data('rw');
    var jeniskelamin = $(e.relatedTarget).data('jenis_kelamin');
    var alamat = $(e.relatedTarget).data('alamat');
    var nohp = $(e.relatedTarget).data('no_hp');

    $(e.currentTarget).find('input[name="nik"]').val(nik);
    $(e.currentTarget).find('input[name="nama"]').val(nama);
    $(e.currentTarget).find('select[name="rt"]').val(rt);
    $(e.currentTarget).find('select[name="rw"]').val(rw);
    $(e.currentTarget).find('select[name="jenis_kelamin"]').val(jeniskelamin);
    $(e.currentTarget).find('input[name="alamat"]').val(alamat);
    $(e.currentTarget).find('input[name="no_hp"]').val(nohp);


  });
</script>
</body>

</html>