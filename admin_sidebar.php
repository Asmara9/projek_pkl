<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item">
    <a href="../admin_dashboard" class="nav-link <?php if ($konstruktor == 'admin_dashboard') {
                                                    echo 'active';
                                                  } ?>">
      <i class="fas fa-tachometer-alt nav-icon"></i>
      <p>Dashboard</p>
    </a>
  </li>
  <li class="nav-item <?php if ($konstruktor == 'admin_penduduk') {
                        echo 'menu-open';
                      }
                      if ($konstruktor == 'admin_kategori_pengantar') {
                        echo 'menu-open';
                      }
                      if ($konstruktor == 'admin_agama') {
                        echo 'menu-open';
                      }
                      if ($konstruktor == 'admin_master_dosen') {
                        echo 'menu-open';
                      }
                      if ($konstruktor == 'admin_master_periode') {
                        echo 'menu-open';
                      }
                      if ($konstruktor == 'admin_master_RW') {
                        echo 'menu-open';
                      }
                      if ($konstruktor == 'admin_master_RT') {
                        echo 'menu-open';
                      }
                      if ($konstruktor == 'admin_status') {
                        echo 'menu-open';
                      } ?>">
    <a href="#" class="nav-link <?php if ($konstruktor == 'admin_penduduk') {
                                  echo 'active';
                                }
                                if ($konstruktor == 'admin_kategori_pengantar') {
                                  echo 'active';
                                }
                                if ($konstruktor == 'admin_master_agama') {
                                  echo 'active';
                                }
                                if ($konstruktor == 'admin_master_dosen') {
                                  echo 'active';
                                }
                                if ($konstruktor == 'admin_master_periode') {
                                  echo 'active';
                                }
                                if ($konstruktor == 'admin_master_RW') {
                                  echo 'active';
                                }
                                if ($konstruktor == 'admin_master_RT') {
                                  echo 'active';
                                }
                                if ($konstruktor == 'admin_status') {
                                  echo 'active';
                                } ?>">
      <i class="nav-icon fas fa-database"></i>
      <p>
        Master Data
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="../admin_kategori_pengantar" class="nav-link <?php if ($konstruktor == 'admin_kategori_pengantar') {
                                                                echo 'active';
                                                              } ?>">
          <i class="fas fa-list-alt nav-icon"></i>
          <p>Kategori Pengantar</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="../admin_agama" class="nav-link <?php if ($konstruktor == 'admin_agama') {
                                                    echo 'active';
                                                  } ?>">
          <i class="fas fa-kaaba nav-icon"></i>
          <p>Agama</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="../admin_penduduk" class="nav-link <?php if ($konstruktor == 'admin_penduduk') {
                                                      echo 'active';
                                                    } ?>">
          <i class="fas fa-users nav-icon"></i>
          <p>Penduduk</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="../admin_master_RW" class="nav-link <?php if ($konstruktor == 'admin_master_RW') {
                                                        echo 'active';
                                                      } ?>">
          <i class="fas fa-users nav-icon"></i>
          <p>RW</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="../admin_master_RT" class="nav-link <?php if ($konstruktor == 'admin_master_RT') {
                                                        echo 'active';
                                                      } ?>">
          <i class="fas fa-users nav-icon"></i>
          <p>RT</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="../admin_status" class="nav-link <?php if ($konstruktor == 'admin_status') {
                                                    echo 'active';
                                                  } ?>">
          <i class="fas fa-spinner fa-spin nav-icon"></i>
          <p>Status</p>
        </a>
      </li>

    </ul>
  </li>

  <li class="nav-item">
    <a href="../admin_data_pengajuan" class="nav-link <?php if ($konstruktor == 'admin_pengajuan') {
                                                        echo 'active';
                                                      } ?>">
      <i class="fas fa-list-alt nav-icon"></i>
      <p>Data Pengajuan
        <?php
        $queryPengajuanBaru = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_pengajuan FROM tbl_permohonan_surat WHERE status = 3") or die(mysqli_error($koneksi));
        $dataPengajuanBaru = mysqli_fetch_assoc($queryPengajuanBaru);
        $jumlahPengajuanBaru = $dataPengajuanBaru['jumlah_pengajuan'];
        if ($jumlahPengajuanBaru > 0) { ?>
          <span style="float: right;" class="badge badge-warning"><?= $jumlahPengajuanBaru; ?></span>
        <?php } ?>
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../admin_laporan_pengajuan" class="nav-link <?php if ($konstruktor == 'admin_laporan_pengajuan') {
                                                            echo 'active';
                                                          } ?>">
      <i class="fas fa-clipboard nav-icon"></i>
      <p>Laporan Pengajuan</p>
    </a>
  </li>

  <li class="nav-item">
    <a href="../admin_gantipw" class="nav-link <?php if ($konstruktor == 'admin_gantipw') {
                                                  echo 'active';
                                                } ?>">
      <i class="fas fa-lock nav-icon"></i>
      <p>Ganti Password</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../konfigurasi_sistem" class="nav-link <?php if ($konstruktor == 'konfigurasi_sistem') {
                                                      echo 'active';
                                                    } ?>">
      <i class="fas fa-cog nav-icon"></i>
      <p>Konfigurasi</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../login/logout.php" class="nav-link">
      <i class="fas fa-sign-out-alt nav-icon"></i>
      <p>Keluar</p>
    </a>
  </li>