<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

  <li class="nav-item">
    <a href="../rw_dashboard" class="nav-link <?php if ($konstruktor == 'rw_dashboard') {
                                                echo 'active';
                                              } ?>">
      <i class="fas fa-tachometer-alt nav-icon"></i>
      <p>Dashboard</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../rw_data_pengajuan" class="nav-link <?php if ($konstruktor == 'rw_data_pengajuan') {
                                                      echo 'active';
                                                    } ?>">
      <i class="fas fa-list-alt nav-icon"></i>
      <p>Data Pengajuan
        <?php
        $nik = @$_SESSION['username'];
        // Query panggil rw
        $pgl_rw = mysqli_query($koneksi, "SELECT rw FROM tbl_rw WHERE nik='$nik'") or die(mysqli_error($koneksi));
        $arr_rw = mysqli_fetch_assoc($pgl_rw);
        $rw = $arr_rw['rw'];
        // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
        $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE rw='$rw' AND status = 2") or die(mysqli_error($koneksi));
        // Ambil data hasil query
        $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
        $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];
        // Jika ada pengajuan baru, tampilkan jumlahnya
        if ($jumlahPengajuanBaru > 0) { ?>
          <span style="float: right;" class="badge badge-warning"><?= $jumlahPengajuanBaru; ?></span>
        <?php } ?>
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../rw_laporan_pengajuan" class="nav-link <?php if ($konstruktor == 'rw_laporan_pengajuan') {
                                                        echo 'active';
                                                      } ?>">
      <i class="fas fa-clipboard nav-icon"></i>
      <p>Laporan Pengajuan</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../rw_profil" class="nav-link <?php if ($konstruktor == 'rw_profil') {
                                              echo 'active';
                                            } ?>">
      <i class="fas fa-user nav-icon"></i>
      <p>Profil RW</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../rw_gantipw" class="nav-link <?php if ($konstruktor == 'rw_gantipw') {
                                              echo 'active';
                                            } ?>">
      <i class="fas fa-lock nav-icon"></i>
      <p>Ganti Password</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../login/logout.php" class="nav-link">
      <i class="fas fa-sign-out-alt nav-icon"></i>
      <p>Keluar</p>
    </a>
  </li>
</ul>
</li>