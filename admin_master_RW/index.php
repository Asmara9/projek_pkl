<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sigap | Dashboard Admin</title>

  <?php
  session_start();
  $konstruktor = 'admin_master_RW';
  require_once '../database/config.php';
  if ($_SESSION['status'] != 0) {
    $usr = $_SESSION['username'];
    $waktu = date('Y-m-d H:i:s');
    $auth = $_SESSION['status'];
    $nama = $_SESSION['nama_user'];
    if ($auth == 1) {
      $tersangka = "Rw";
    }
    if ($auth == 2) {
      $tersangka = "Penduduk";
    }

    $ket = "Pengguna dengan username " . $usr . " , nama : " . $nama . " melakukan cross authority dengan akses sebagai " . $tersangka;
    $querycrossauth = mysqli_query($koneksi, "INSERT INTO tbl_cross_auth VALUES ('','$usr','$waktu','$ket')") or die(mysqli_error($koneksi));

    echo '<script>window.location="../login/logout.php"</script>';
  } else {
    include '../listlink.php';
  ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php
    $pgllogoapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=1") or die(mysqli_error($koneksi));
    $arrapp = mysqli_fetch_array($pgllogoapp);
    $logoapp = $arrapp['lokasi_file'];

    $pglnamaapp = mysqli_query($koneksi, "SELECT * FROM tbl_konfigurasi WHERE id=3") or die(mysqli_error($koneksi));
    $arrnamaapp = mysqli_fetch_array($pglnamaapp);
    $namaAppBaru = $arrnamaapp['elemen'];
    ?>

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
              <h1 class="m-0">Master Data RW</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Master Data RW</li>
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
                  <h3 class="card-title"><i class="nav-icon fas fa-list"></i> Data RW</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                  <a href="tambahrw.php" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-download"></i> Tambah Data</a>
                  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-import">
                    <i class="nav-icon fas fa-file-excel"></i> Import Excel
                  </button>
                  <a href="prosesreset.php?reset=reset" class="btn btn-danger btn-sm" onclick="return confirm('Yakin cikkk???')"><i class="nav-icon fas fa-sync"></i> Reset Data</a>
                  <br>
                  <br>
                  <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>
                          <center>NIK</center>
                        </th>
                        <th>
                          <center>RW</center>
                        </th>
                        <th>
                          <center>Nama Ketua</center>
                        </th>
                        <th>
                          <center>Kontak </center>
                        </th>
                        <th>
                          <center>Aksi</center>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      //panggil data pada tbl_rw
                      $queryrw = mysqli_query($koneksi, "SELECT * FROM tbl_rw") or die(mysqli_error($koneksi));

                      //jika tabel ada isinya maka ditampilkan datanya
                      if (mysqli_num_rows($queryrw) > 0) {
                        while ($dt_rw = mysqli_fetch_array($queryrw)) {
                      ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $dt_rw['nik'] ?></td>
                            <td><?= $dt_rw['rw'] ?></td>
                            <td><?= $dt_rw['ketua'] ?></td>
                            <td><?= $dt_rw['kontak'] ?></td>

                            <td>
                              <center>
                                <button type="button" class="btn btn-sm btn-warning btn-edit" data-toggle="modal" data-target="#modal-edit"
                                  data-nik="<?= $dt_rw['nik']; ?>"
                                  data-rw="<?= $dt_rw['rw']; ?>"
                                  data-ketua="<?= $dt_rw['ketua']; ?>"
                                  data-kontak="<?= $dt_rw['kontak']; ?>"
                                  data-alamat="<?= $dt_rw['alamat']; ?>">
                                  <i class="nav-icon fas fa-edit"></i>
                                </button>
                                <!-- Hapus -->
                                <a href="proseshapus.php?kd_rw=<?= encriptData($dt_rw['nik']); ?>&hapus=hapus" class="btn btn-sm btn-danger" onclick="return confirm('Anda akan menghapus data rw dengan NIK rw [<?= encriptData($dt_rw['nik']) ?>] - Ketua : [<?= $dt_rw['ketua']; ?>]')"><i class="fas fa-trash"> </i>
                                </a>
                                <a href="detailrw.php?id=<?= encriptData($dt_rw['id'] . '&' . $dt_rw['ketua']); ?>" class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i></a>
                                <!-- <a href="detail_rt_per_rw.php?id=<?= encriptData($dt_rw['id'] . '&' . $dt_rw['ketua']) ?>" class="btn btn-sm btn-info"><i class="fas fa-users"></i></a> -->
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
                          <td colspan="7">Tidak ditemukan data angkatan pada database</td>
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

<!-- Modal Import -->
<div class="modal fade" id="modal-import">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#001f3f;">
        <h4 class="modal-title">
          <font color="#ffffff"><i class="fas fa-file-excel"></i> Import Data RW</font>
        </h4>
      </div>

      <div class="modal-body">
        <a href="download.php?filename=template_rw.xls" class="btn btn-sm btn-secondary"><i class="nav-icon fas fa-file"></i> Download Template Import Excel</a>
        <form id="modal-import" action="import.php" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-body">
                <div class="form-group row">
                  <label style="text-align: center;" for="import" class="col-sm-12 control-label">Ambil File Excel </label>
                  <div class="col-sm-12">
                    <input type="file" class="form-control" name="file" id="import" placeholder="Ambil File Excel" accept="application/vnd.ms.excel" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="imporrw" class="btn btn-primary"><i class="nav-icon fas fa-upload"></i> Import File</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background-color: blue;">
        <h4 class="modal-title">
          <font color="#ffffff"><i class="fas fa-file"></i> Edit Data RW</font>
        </h4>
      </div>
      <form id="#modal-edit" action="editrw.php" method="POST">
        <div class="modal-body">
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="form-group row">
                  <label for="data-id" class="col-sm-12 control-label">NIK RW</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="nik" id="nik" disabled>
                    <input type="text" class="form-control" name="nik" id="nik" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-rw" class="col-sm-12 control-label">RW</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="rw" id="rw" disabled>
                    <input type="text" class="form-control" name="rw" id="rw" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-ketua" class="col-sm-12 control-label">Nama Ketua</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="ketua" id="ketua">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-kontak" class="col-sm-12 control-label">Kontak</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="kontak" id="kontak">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="data-alamat" class="col-sm-12 control-label">Alamat</label>
                  <div class="col-sm-12">
                    <input type="text" class="form-control" name="alamat" id="alamat">
                  </div>
                </div>

              </div>
              </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" name="editrw" class="btn btn-primary" style="background-color:blue">Simpan Perubahan</button>
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
    var rw = $(e.relatedTarget).data('rw');
    var ketua = $(e.relatedTarget).data('ketua');
    var kontak = $(e.relatedTarget).data('kontak');
    var alamat = $(e.relatedTarget).data('alamat');

    $(e.currentTarget).find('input[name="nik"]').val(nik);
    $(e.currentTarget).find('input[name="rw"]').val(rw);
    $(e.currentTarget).find('input[name="ketua"]').val(ketua);
    $(e.currentTarget).find('input[name="kontak"]').val(kontak);
    $(e.currentTarget).find('input[name="alamat"]').val(alamat);



  });
</script>
</body>

</html>