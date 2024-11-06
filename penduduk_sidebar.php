<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

  <li class="nav-item">
    <a href="../penduduk_dashboard" class="nav-link <?php if ($konstruktor == 'penduduk_dashboard') {
                                                      echo 'active';
                                                    } ?>">
      <i class="fas fa-tachometer-alt nav-icon"></i>
      <p>Dashboard</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../surat_dashboard" class="nav-link <?php if ($konstruktor == 'surat_dashboard') {
                                                    echo 'active';
                                                  } ?>">
      <i class="fas fa-list-alt nav-icon"></i>
      <p>Data Pengajuan
        <?php
        $nik = @$_SESSION['username'];
        // Query untuk menghitung jumlah pengajuan berdasarkan nik yang sedang login
        $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE nik='$nik' AND status != 4") or die(mysqli_error($koneksi));
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
    <a href="../penduduk_laporan_pengajuan" class="nav-link <?php if ($konstruktor == 'penduduk_laporan_pengajuan') {
                                                              echo 'active';
                                                            } ?>">
      <i class="fas fa-clipboard nav-icon"></i>
      <p>Laporan Pengajuan</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../profil_penduduk" class="nav-link <?php if ($konstruktor == 'profil_penduduk') {
                                                    echo 'active';
                                                  } ?>">
      <i class="fas fa-user nav-icon"></i>
      <p>Profil Penduduk</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../penduduk_gantipw" class="nav-link <?php if ($konstruktor == 'penduduk_gantipw') {
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