<!DOCTYPE html>
<html lang="en">
<?php
require_once './database/config.php';
?>
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

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $namaAppBaru ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="./img/desa.png" rel="icon">
    <link href="./frontend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./frontend/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="./frontend/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./frontend/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="./frontend/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Lumia
  * Template URL: https://bootstrapmade.com/lumia-bootstrap-business-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h4 class="sitename"><b><?= $namaCopyright; ?></b></h4>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Profil</a></li>
                    <li><a href="#services">Pelayanan</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#contact">Kontak</a></li>
                    <li><a href="login/">Login</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="./img/desa.png" alt="" data-aos="fade-in">

            <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2>Selamat Datang di</h2>
                        <p>Website Sistem Informasi Pengantar Surat Desa Cilibur</p>
                        <a href="#about" class="btn-get-started">Get Started</a>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Profil</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-3">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="./frontend/assets/img/about.jpg" alt="" class="img-fluid">
                    </div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="about-content ps-0 ps-lg-3">
                            <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                            <p class="fst-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li>
                                    <i class="bi bi-diagram-3"></i>
                                    <div>
                                        <h4>Ullamco laboris nisi ut aliquip consequat</h4>
                                        <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bi bi-fullscreen-exit"></i>
                                    <div>
                                        <h4>Magnam soluta odio exercitationem reprehenderi</h4>
                                        <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata redi</p>
                                    </div>
                                </li>
                            </ul>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                                in
                                culpa qui officia deserunt mollit anim id est laborum
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Pelayanan</h2>
                <p>Website ini dibuat untuk melayani pengantar surat desa bagi warga Desa Cilibur yang sedang berada di luar desa atau merantau.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item  position-relative">
                            <div class="icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Surat Keterangan Tidak Mampu</h3>
                            </a>
                            <p>Surat Keterangan Tidak Mampu (SKTM) adalah dokumen resmi yang diterbitkan oleh pemerintah setempat (kelurahan/desa) yang menyatakan bahwa seseorang atau keluarga berada dalam kondisi ekonomi kurang mampu.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Surat Bantuan PKH</h3>
                            </a>
                            <p>Surat Keterangan ini dikeluarkan oleh pihak yang berwenang untuk menyatakan bahwa penerima bantuan terdaftar sebagai peserta Program Keluarga Harapan (PKH). Program ini merupakan bantuan sosial bersyarat dari pemerintah yang ditujukan untuk keluarga miskin atau rentan miskin, dengan tujuan untuk meningkatkan kualitas hidup keluarga melalui peningkatan akses pendidikan, kesehatan, dan kesejahteraan sosial.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Surat Keterangan Kelahiran</h3>
                            </a>
                            <p>Surat Keterangan Kelahiran adalah dokumen resmi yang diterbitkan oleh instansi berwenang, seperti rumah sakit, bidan, atau puskesmas, yang berisi informasi terkait kelahiran seorang anak.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Surat Keterangan Kematian</h3>
                            </a>
                            <p>Surat Keterangan Kematian adalah dokumen resmi yang dikeluarkan oleh instansi berwenang, seperti kantor desa/kelurahan atau rumah sakit, yang menyatakan secara sah bahwa seseorang telah meninggal dunia. Surat ini memuat informasi penting seperti identitas almarhum, tanggal, tempat, dan penyebab kematian, serta keterangan dari pihak yang berwenang. Surat keterangan kematian diperlukan untuk berbagai keperluan administrasi, seperti pengurusan akta kematian, klaim asuransi, pengalihan warisan, serta pembaruan status kependudukan.</p>
                            <a href="service-details.html" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Surat Keterangan Usaha</h3>
                            </a>
                            <p>Surat Keterangan Usaha (SKU) adalah dokumen resmi yang dikeluarkan oleh pemerintah desa atau kelurahan yang berfungsi sebagai bukti bahwa seseorang benar memiliki usaha di wilayah tersebut. SKU biasanya diperlukan untuk berbagai keperluan, seperti pengajuan kredit usaha, syarat pendirian badan usaha, atau untuk keperluan administrasi lainnya yang membutuhkan bukti legalitas usaha.</p>
                            <a href="service-details.html" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <a href="service-details.html" class="stretched-link">
                                <h3>Suarat Keterangan Pengantar Nikah</h3>
                            </a>
                            <p>Surat Keterangan Pengantar Nikah adalah dokumen resmi yang dikeluarkan oleh instansi pemerintah, biasanya oleh kelurahan atau kecamatan, yang berfungsi sebagai bukti bahwa pasangan yang akan menikah telah memenuhi syarat-syarat administrasi dan hukum untuk melangsungkan pernikahan. Surat ini diperlukan sebagai salah satu syarat dalam proses pendaftaran pernikahan di KUA (Kantor Urusan Agama) atau lembaga yang berwenang lainnya.</p>
                            <a href="service-details.html" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-product">Product</li>
                        <li data-filter=".filter-branding">Branding</li>
                        <li data-filter=".filter-books">Books</li>
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="./frontend/assets/img/portfolio/app-1.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 1</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/app-1.jpg" title="App 1" data-gallery="portfolio-gallery-app"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <img src="./frontend/assets/img/portfolio/product-1.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Product 1</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/product-1.jpg" title="Product 1" data-gallery="portfolio-gallery-product"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <img src="./frontend/assets/img/portfolio/branding-1.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Branding 1</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/branding-1.jpg" title="Branding 1"
                                    data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                            <img src="./frontend/assets/img/portfolio/books-1.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Books 1</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/books-1.jpg" title="Branding 1" data-gallery="portfolio-gallery-book"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="./frontend/assets/img/portfolio/app-2.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 2</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/app-2.jpg" title="App 2" data-gallery="portfolio-gallery-app"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <img src="./frontend/assets/img/portfolio/product-2.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Product 2</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/product-2.jpg" title="Product 2" data-gallery="portfolio-gallery-product"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <img src="./frontend/assets/img/portfolio/branding-2.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Branding 2</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/branding-2.jpg" title="Branding 2"
                                    data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                            <img src="./frontend/assets/img/portfolio/books-2.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Books 2</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/books-2.jpg" title="Branding 2" data-gallery="portfolio-gallery-book"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                            <img src="./frontend/assets/img/portfolio/app-3.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>App 3</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/app-3.jpg" title="App 3" data-gallery="portfolio-gallery-app"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                            <img src="./frontend/assets/img/portfolio/product-3.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Product 3</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/product-3.jpg" title="Product 3" data-gallery="portfolio-gallery-product"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                            <img src="./frontend/assets/img/portfolio/branding-3.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Branding 3</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/branding-3.jpg" title="Branding 2"
                                    data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                        class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                            <img src="./frontend/assets/img/portfolio/books-3.jpg" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>Books 3</h4>
                                <p>Lorem ipsum, dolor sit amet consectetur</p>
                                <a href="./frontend/assets/img/portfolio/books-3.jpg" title="Branding 3" data-gallery="portfolio-gallery-book"
                                    class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                        class="bi bi-link-45deg"></i></a>
                            </div>
                        </div><!-- End Portfolio Item -->

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Portfolio Section -->

        <!-- Team Section -->
        <section class="team-15 team section" id="team">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>Website ini dibuat oleh:</p>
            </div><!-- End Section Title -->

            <div class="content">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="person">
                                <figure>
                                    <img src="./frontend/assets/img/team/team-1.jpg" alt="Image" class="img-fluid">
                                    <div class="social">
                                        <a href="#"><span class="bi bi-facebook"></span></a>
                                        <a href="#"><span class="bi bi-twitter-x"></span></a>
                                        <a href="#"><span class="bi bi-linkedin"></span></a>
                                    </div>
                                </figure>
                                <div class="person-contents">
                                    <h3>Candrasa Asmaradanta</h3>
                                    <span class="position">Back End Developer/Report Compiler</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="person">
                                <figure>
                                    <img src="./frontend/assets/img/team/team-2.jpg" alt="Image" class="img-fluid">
                                    <div class="social">
                                        <a href="#"><span class="bi bi-facebook"></span></a>
                                        <a href="#"><span class="bi bi-twitter-x"></span></a>
                                        <a href="#"><span class="bi bi-linkedin"></span></a>
                                    </div>
                                </figure>
                                <div class="person-contents">
                                    <h3>Dendi Zidni Ilman</h3>
                                    <span class="position">Front End/Report Compiler</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="person">
                                <figure>
                                    <img src="./frontend/assets/img/team/team-3.jpg" alt="Image" class="img-fluid">
                                    <div class="social">
                                        <a href="#"><span class="bi bi-facebook"></span></a>
                                        <a href="#"><span class="bi bi-twitter-x"></span></a>
                                        <a href="#"><span class="bi bi-linkedin"></span></a>
                                    </div>
                                </figure>
                                <div class="person-contents">
                                    <h3>Utama Aslahatul F</h3>
                                    <span class="position">Front End/Report Compiler</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Team Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak</h2>
                <p>Hubungi Admin untuk mendapatkan akun.</p>
            </div><!-- End Section Title -->

            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-5">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Alamat</h3>
                                <p>Cilibur</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Nomor WhatsApp</h3>
                                <a href="https://wa.me/6281295412056" target="_blank">
                                    <p>0812 9541 2056</p>
                                </a>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email</h3>
                                <p>admindesacilibur001@gmail.com</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                    <div class="col-lg-7">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="500">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit"><i class="fas fa-paper-plane"></i> Kirim</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer light-background">

        <!-- <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Lumia</span>
                    </a>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta
                        donna mare fermentum iaculis eu non diam phasellus.</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p>United States</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>

            </div>
        </div> -->

        <div class="container copyright text-center mt-4">
            <footer class="main-footer">
                <strong>Copyright &copy; <?php echo date('Y') ?> <?= $namaCopyright; ?> <a href="#"><?= $namaDesa ?></a> </strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.2.0
                </div>
            </footer>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="./frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./frontend/assets/vendor/php-email-form/validate.js"></script>
    <script src="./frontend/assets/vendor/aos/aos.js"></script>
    <script src="./frontend/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="./frontend/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="./frontend/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="./frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="./frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="./frontend/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="./frontend/assets/js/main.js"></script>

</body>

</html>