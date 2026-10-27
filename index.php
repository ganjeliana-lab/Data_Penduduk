<?php

$total_penduduk = 2531;
$laki_laki      = 1240;
$perempuan      = 1291;
$jumlah_kk      = 675;

// ------------------------------------------------------
// DATA GALERI
// ------------------------------------------------------
$galeri = [
    [
        'gambar' => 'assets/img/galeri1.jpg',
        'judul'  => 'Kantor lurah waioti'
    ],
    [
        'gambar' => 'assets/img/galeri2.jpg',
        'judul'  => 'Kegiatan Musyawarah kelurahan'
    ],
    [
        'gambar' => 'assets/img/galeri3.jpg',
        'judul'  => 'Gotong Royong Warga'
    ],
    [
        'gambar' => 'assets/img/galeri4.jpg',
        'judul'  => 'Pemandangan Alam kelurahan'
    ],

    [
        'gambar' => 'assets/img/galeri1.jpg',
        'judul'  => 'Kantor lurah waioti'
    ],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="Sistem Informasi Data Penduduk KELURAHAN WAIOTI">

    <meta name="author" content="KELURAHAN WAIOTI">

    <title>Sistem Informasi Data Penduduk - KELURAHAN WAIOTI</title>

    <!-- ==================================================
         FONT
    ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- ==================================================
         FONT AWESOME
    ================================================== -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- ==================================================
         CSS
    ================================================== -->
    <style>

        /* ==================================================
           RESET
        ================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f9fc;
            color: #193452;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            display: block;
        }

        button,
        input {
            font-family: inherit;
        }

        .container {
            width: min(1080px, 92%);
            margin: auto;
        }


        /* ==================================================
           NAVBAR
        ================================================== */

        .navbar {
            height: 62px;
            background: #ffffff;
            border-bottom: 1px solid #e7edf2;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .nav-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 25px;
        }

        /* LOGO */

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 270px;
        }

        .brand-logo {
            width: 43px;
            height: 43px;
            object-fit: contain;
        }

        .brand-text {
            line-height: 1.15;
        }

        .brand-text h1 {
            font-size: 15px;
            font-weight: 800;
            color: #183452;
        }

        .brand-text span {
            font-size: 10px;
            color: #66788c;
        }

        /* MENU */

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .nav-link {
            height: 62px;
            padding: 0 13px;
            display: flex;
            align-items: center;
            gap: 8px;

            font-size: 11px;
            font-weight: 600;
            color: #203d5d;

            position: relative;
            transition: .25s;
        }

        .nav-link i {
            font-size: 13px;
        }

        .nav-link:hover {
            color: #07805f;
        }

        .nav-link.active {
            color: #087d5d;
        }

        .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 15px;
            right: 15px;
            height: 3px;
            background: #07805f;
            border-radius: 10px 10px 0 0;
        }

        .dropdown-icon {
            font-size: 8px !important;
            margin-left: 2px;
        }

        /* NAV RIGHT */

        .nav-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .search-nav {
            font-size: 16px;
            color: #183452;
            cursor: pointer;
        }

        .login-btn {
            display: flex;
            align-items: center;
            gap: 8px;

            background: linear-gradient(
                135deg,
                #087f60,
                #075f4a
            );

            color: white;
            padding: 9px 17px;
            border-radius: 25px;

            font-size: 11px;
            font-weight: 700;

            box-shadow: 0 5px 15px rgba(8, 127, 96, .20);
            transition: .25s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(8, 127, 96, .30);
        }


        /* ==================================================
           HERO
        ================================================== */

        .hero {
            min-height: 310px;

            background-image:
                linear-gradient(
                    90deg,
                    rgba(6, 42, 64, .92) 0%,
                    rgba(7, 53, 76, .75) 35%,
                    rgba(7, 53, 76, .12) 75%
                ),
                url('img/kantor.jpg');

            background-size: cover;
            background-position: center;

            position: relative;
            display: flex;
            align-items: center;
        }

        .hero-content {
            color: white;
            width: 550px;
            padding: 35px 0;
        }

        .hero-small {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .hero-title {
            font-size: 39px;
            line-height: 1.05;
            font-weight: 800;
            letter-spacing: -1.5px;
        }

        .hero-title .green {
            color: #23e4bd;
        }

        .hero-village {
            font-size: 19px;
            font-weight: 700;
            color: #3ee9c5;
            margin-top: 4px;
        }

        .hero-description {
            font-size: 11px;
            line-height: 1.7;
            margin-top: 9px;
            color: rgba(255,255,255,.88);
            max-width: 500px;
        }


        /* ==================================================
           SEARCH
        ================================================== */

        .hero-search {
            margin-top: 18px;
            background: white;
            width: 555px;
            height: 43px;

            display: flex;
            align-items: center;

            border-radius: 25px;
            padding: 4px 5px 4px 18px;

            box-shadow: 0 8px 25px rgba(0,0,0,.14);
        }

        .hero-search i {
            color: #173b59;
            font-size: 16px;
        }

        .hero-search input {
            flex: 1;
            border: none;
            outline: none;
            padding: 0 12px;

            font-size: 10px;
            color: #555;
        }

        .hero-search input::placeholder {
            color: #9aa5ae;
        }

        .search-btn {
            border: none;
            cursor: pointer;

            background: #0a8a69;
            color: white;

            height: 35px;
            min-width: 105px;

            border-radius: 20px;

            font-size: 12px;
            font-weight: 700;

            transition: .25s;
        }

        .search-btn:hover {
            background: #076b52;
        }


        /* ==================================================
           QUICK SERVICES
        ================================================== */

        .services {
            padding: 20px 0 12px;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .service-card {
            background: white;
            min-height: 93px;

            border: 1px solid #e2eaf0;
            border-radius: 9px;

            display: flex;
            align-items: center;

            padding: 12px;

            box-shadow: 0 5px 18px rgba(22, 61, 88, .05);

            transition: .25s;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(22, 61, 88, .10);
        }

        .service-icon {
            width: 61px;
            height: 61px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            font-size: 25px;
            color: white;

            margin-right: 13px;
        }

        .blue {
            background: linear-gradient(135deg,#2ca8ec,#1773d5);
        }

        .green-icon {
            background: linear-gradient(135deg,#31bd75,#07965c);
        }

        .purple {
            background: linear-gradient(135deg,#8b63e9,#6741d8);
        }

        .orange {
            background: linear-gradient(135deg,#ffad2e,#f1850b);
        }

        .service-info {
            flex: 1;
        }

        .service-info h3 {
            font-size: 12px;
            font-weight: 800;
            color: #193452;
            margin-bottom: 4px;
        }

        .service-info p {
            font-size: 9px;
            line-height: 1.5;
            color: #6c7d8f;
        }

        .service-arrow {
            width: 30px;
            height: 30px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #edf8f4;
            color: #0b8b69;

            font-size: 12px;
        }

        .purple-arrow {
            background: #f1edfc;
            color: #7351d9;
        }

        .orange-arrow {
            background: #fff5e7;
            color: #ed941c;
        }


        /* ==================================================
           ABOUT + STATISTICS
        ================================================== */

        .about-section {
            padding: 13px 0 17px;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1.05fr 1.45fr;
            gap: 20px;
        }

        .about-card {
            background: white;
            border-radius: 9px;
            padding: 20px 22px;

            border: 1px solid #e3eaf0;
            box-shadow: 0 5px 18px rgba(22, 61, 88, .05);

            position: relative;
            overflow: hidden;
        }

        .about-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #10a579;
        }

        .section-label {
            font-size: 10px;
            font-weight: 700;
            color: #087d5d;
            margin-bottom: 3px;
        }

        .about-card h2 {
            font-size: 25px;
            color: #183452;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .about-card p {
            font-size: 11px;
            color: #687b8e;
            line-height: 1.8;
        }

        .more-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            background: #0b8062;
            color: white;

            padding: 8px 15px;
            border-radius: 18px;

            font-size: 10px;
            font-weight: 700;

            margin-top: 11px;
        }

        .more-btn:hover {
            background: #08674f;
        }


        /* STATISTIC */

        .population-card {
            background: white;
            border: 1px solid #dcebe7;
            border-radius: 9px;

            overflow: hidden;

            display: grid;
            grid-template-columns: 1fr 1.55fr;
        }

        .population-image {
            min-height: 185px;
            background-size: cover;
            background-position: center;
            background-image: url('assets/img/desa.jpg');
        }

        .population-data {
            padding: 12px 13px;
        }

        .population-title {
            color: #087c5c;
            font-size: 11px;
            font-weight: 800;

            margin-bottom: 8px;

            display: flex;
            align-items: center;
            gap: 8px;
        }

        .population-title i {
            color: #18bc8c;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 9px;
        }

        .stat-box {
            min-height: 60px;

            border: 1px solid #edf1f4;
            border-radius: 8px;

            background: #fbfdfe;

            display: flex;
            align-items: center;
            gap: 10px;

            padding: 9px;
        }

        .stat-icon {
            width: 28px;
            color: #137dd7;
            font-size: 21px;
            text-align: center;
        }

        .stat-box:nth-child(3) .stat-icon {
            color: #ef3d76;
        }

        .stat-box:nth-child(4) .stat-icon {
            color: #0c8c68;
        }

        .stat-number {
            font-size: 16px;
            line-height: 1;
            font-weight: 800;
            color: #193452;
        }

        .stat-label {
            margin-top: 4px;
            font-size: 8px;
            color: #6d7f91;
        }


        /* ==================================================
           GALLERY
        ================================================== */

        .gallery-section {
            padding: 0 0 20px;
        }

        .gallery-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 11px;
        }

        .gallery-title {
            border-left: 3px solid #19d6a5;
            padding-left: 12px;
        }

        .gallery-title .section-label {
            margin-bottom: 1px;
        }

        .gallery-title h2 {
            font-size: 21px;
            color: #193452;
            line-height: 1.2;
        }

        .view-all {
            color: #087b5d;
            font-size: 10px;
            font-weight: 700;

            display: flex;
            align-items: center;
            gap: 8px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .gallery-card {
            background: white;

            border: 1px solid #e1e8ed;
            border-radius: 8px;

            overflow: hidden;

            box-shadow: 0 5px 16px rgba(20, 54, 78, .05);

            transition: .25s;
        }

        .gallery-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(20, 54, 78, .11);
        }

        .gallery-image {
            width: 100%;
            height: 93px;
            object-fit: cover;
        }

        .gallery-caption {
            height: 36px;

            display: flex;
            align-items: center;
            gap: 8px;

            padding: 0 12px;

            font-size: 9px;
            color: #465c71;
        }

        .gallery-caption i {
            width: 18px;
            height: 18px;

            border-radius: 4px;

            background: #0b8c69;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 9px;
        }


        /* ==================================================
           FOOTER
        ================================================== */

        footer {
            background: #193b57;
            color: white;
            margin-top: 0;
        }

        .footer-main {
            padding: 12px 0 7px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .footer-brand img {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .footer-brand h3 {
            font-size: 11px;
            line-height: 1.2;
        }

        .footer-brand span {
            font-size: 7px;
            color: #bdcad5;
        }

        .footer-links {
            display: flex;
            gap: 22px;
        }

        .footer-links a {
            font-size: 8px;
            color: #d6e0e8;
        }

        .footer-links a:hover {
            color: #35dfb7;
        }

        .social {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .social span {
            font-size: 8px;
            margin-right: 5px;
            color: #d2dce4;
        }

        .social a {
            width: 20px;
            height: 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            color: white;
            font-size: 10px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.15);
            padding: 7px 0 9px;

            text-align: center;

            font-size: 7px;
            color: #bdcad5;
        }


        /* ==================================================
           MOBILE MENU BUTTON
        ================================================== */

        .mobile-menu {
            display: none;

            border: none;
            background: transparent;

            font-size: 20px;
            color: #193452;

            cursor: pointer;
        }


        /* ==================================================
           RESPONSIVE
        ================================================== */

        @media (max-width: 1000px) {

            .brand {
                min-width: auto;
            }

            .nav-menu {
                gap: 0;
            }

            .nav-link {
                padding: 0 7px;
                font-size: 10px;
            }

            .service-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }


        @media (max-width: 760px) {

            .navbar {
                height: 65px;
            }

            .nav-container {
                position: relative;
            }

            .mobile-menu {
                display: block;
            }

            .nav-menu {
                display: none;

                position: absolute;

                left: 0;
                right: 0;
                top: 65px;

                background: white;

                flex-direction: column;
                align-items: stretch;

                box-shadow: 0 10px 25px rgba(0,0,0,.10);
                padding: 8px 0;
            }

            .nav-menu.show {
                display: flex;
            }

            .nav-link {
                height: 45px;
                padding: 0 20px;
            }

            .nav-link.active::after {
                display: none;
            }

            .nav-right {
                margin-left: auto;
            }

            .search-nav {
                display: none;
            }

            .hero {
                min-height: 400px;
                background-position: center;
            }

            .hero-content {
                width: 100%;
            }

            .hero-title {
                font-size: 33px;
            }

            .hero-search {
                width: 100%;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .population-card {
                grid-template-columns: 1fr;
            }

            .population-image {
                height: 190px;
            }

            .footer-main {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .footer-links {
                flex-wrap: wrap;
                gap: 13px;
            }
        }


        @media (max-width: 520px) {

            .container {
                width: 92%;
            }

            .brand-text h1 {
                font-size: 13px;
            }

            .brand-text span {
                font-size: 8px;
            }

            .brand-logo {
                width: 37px;
                height: 37px;
            }

            .login-btn {
                padding: 8px 12px;
            }

            .login-btn span {
                display: none;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: 1fr 1fr;
                gap: 9px;
            }

            .gallery-image {
                height: 85px;
            }

            .gallery-caption {
                font-size: 8px;
                padding: 0 8px;
            }

            .hero-title {
                font-size: 29px;
            }

            .hero-village {
                font-size: 17px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

    </style>
</head>

<body>


<!-- =====================================================
     NAVBAR
====================================================== -->

<header class="navbar">

    <div class="container nav-container">

        <!-- LOGO -->
        <a href="index.php" class="brand">

            <img src="img/logo.jpg"
                 alt="Logo Desa Harapan Jaya"
                 class="brand-logo">

            <div class="brand-text">

                <h1>
                    Sistem Informasi<br>
                    Data Penduduk
                </h1>

                <span>
                    Kelurahan Waioti
                </span>

            </div>

        </a>


        <!-- MOBILE BUTTON -->
        <button class="mobile-menu"
                onclick="toggleMenu()">

            <i class="fa-solid fa-bars"></i>

        </button>


        <!-- MENU -->
        <nav class="nav-menu" id="navMenu">

            <a href="index.php"
               class="nav-link active">

                <i class="fa-solid fa-house"></i>

                Beranda

            </a>


            <a href="data_penduduk.php"
               class="nav-link">

                <i class="fa-solid fa-users"></i>

                Data Penduduk

                <i class="fa-solid fa-chevron-down dropdown-icon"></i>

            </a>


            <a href="profil_kelurahan.php"
               class="nav-link">

                <i class="fa-solid fa-building-columns"></i>

                Profil Kelurahan

            </a>


            <a href="galeri.php"
               class="nav-link">

                <i class="fa-solid fa-image"></i>

                Galeri

            </a>


            <a href="informasi.php"
               class="nav-link">

                <i class="fa-solid fa-circle-info"></i>

                Informasi

            </a>

        </nav>


        <!-- RIGHT -->
        <div class="nav-right">

            <div class="search-nav">

                <i class="fa-solid fa-magnifying-glass"></i>

            </div>


            <a href="login.php"
               class="login-btn">

                <i class="fa-solid fa-user"></i>

                <span>Login</span>

            </a>

        </div>

    </div>

</header>



<!-- =====================================================
     HERO
====================================================== -->

<section class="hero">

    <div class="container">

        <div class="hero-content">

            <div class="hero-small">
                Selamat Datang di
            </div>


            <h2 class="hero-title">

                Sistem Informasi

                <br>

                <span class="green">
                    Data Penduduk
                </span>

            </h2>


            <div class="hero-village">
                Kelurahan Waioti
            </div>


            <p class="hero-description">

                Akses informasi kependudukan dengan mudah,
                cepat dan akurat.<br>

                Untuk mewujudkan kelurahan yang lebih maju
                dan sejahtera.

            </p>


            <!-- SEARCH -->
            <form action="data_penduduk.php"
                  method="GET"
                  class="hero-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text"
                       name="keyword"
                       placeholder="Cari nama, NIK, No KK, atau alamat...">

                <button type="submit"
                        class="search-btn">

                    Cari

                </button>

            </form>

        </div>

    </div>

</section>



<!-- =====================================================
     QUICK SERVICE
====================================================== -->

<section class="services">

    <div class="container">

        <div class="service-grid">


            <!-- CARD 1 -->
            <a href="data_penduduk.php"
               class="service-card">

                <div class="service-icon blue">

                    <i class="fa-solid fa-users"></i>

                </div>

                <div class="service-info">

                    <h3>
                        Data Penduduk
                    </h3>

                    <p>
                        Lihat dan cari data
                        penduduk kelurahan
                    </p>

                </div>

                <div class="service-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </div>

            </a>


            <!-- CARD 2 -->
            <a href="kartu-keluarga.php"
               class="service-card">

                <div class="service-icon green-icon">

                    <i class="fa-solid fa-house"></i>

                </div>

                <div class="service-info">

                    <h3>
                        Data Kartu Keluarga
                    </h3>

                    <p>
                        Informasi KK dan
                        anggota keluarga
                    </p>

                </div>

                <div class="service-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </div>

            </a>


            <!-- CARD 3 -->
            <a href="layanan-surat.php"
               class="service-card">

                <div class="service-icon purple">

                    <i class="fa-solid fa-file-lines"></i>

                </div>

                <div class="service-info">

                    <h3>
                        Layanan Surat
                    </h3>

                    <p>
                        Pengajuan surat
                        keterangan
                    </p>

                </div>

                <div class="service-arrow purple-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </div>

            </a>


            <!-- CARD 4 -->
            <a href="informasi.php"
               class="service-card">

                <div class="service-icon orange">

                    <i class="fa-solid fa-info"></i>

                </div>

                <div class="service-info">

                    <h3>
                        Informasi
                    </h3>

                    <p>
                        Berita dan pengumuman
                        terbaru
                    </p>

                </div>

                <div class="service-arrow orange-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </div>

            </a>

        </div>

    </div>

</section>



<!-- =====================================================
     ABOUT + POPULATION
====================================================== -->

<section class="about-section">

    <div class="container">

        <div class="about-grid">


            <!-- ABOUT -->
            <div class="about-card">

                <div class="section-label">
                    Tentang kelurahan waioti
                </div>

                <h2>
                    Data Penduduk
                </h2>

                <p>

                    kelurahan waioti merupakan salah satu
                    kelurahan yang berada di Kecamatan alok timur,
                    dengan potensi alam, budaya, dan masyarakat
                    yang aktif dalam berbagai kegiatan pembangunan.

                </p>

                <a href="profil_kelurahan.php"
                   class="more-btn">

                    Selengkapnya

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>



            <!-- POPULATION -->
            <div class="population-card">


                <!-- IMAGE -->
                <div class="population-image"></div>


                <!-- DATA -->
                <div class="population-data">

                    <div class="population-title">

                        <i class="fa-solid fa-chart-column"></i>

                        Data Penduduk kelurahan

                    </div>


                    <div class="stats-grid">


                        <!-- TOTAL -->
                        <div class="stat-box">

                            <div class="stat-icon">

                                <i class="fa-solid fa-users"></i>

                            </div>

                            <div>

                                <div class="stat-number">
                                    <?= number_format($total_penduduk, 0, ',', '.'); ?>
                                </div>

                                <div class="stat-label">
                                    Total Penduduk
                                </div>

                            </div>

                        </div>


                        <!-- LAKI -->
                        <div class="stat-box">

                            <div class="stat-icon">

                                <i class="fa-solid fa-person"></i>

                            </div>

                            <div>

                                <div class="stat-number">
                                    <?= number_format($laki_laki, 0, ',', '.'); ?>
                                </div>

                                <div class="stat-label">
                                    Laki-laki
                                </div>

                            </div>

                        </div>


                        <!-- PEREMPUAN -->
                        <div class="stat-box">

                            <div class="stat-icon">

                                <i class="fa-solid fa-person-dress"></i>

                            </div>

                            <div>

                                <div class="stat-number">
                                    <?= number_format($perempuan, 0, ',', '.'); ?>
                                </div>

                                <div class="stat-label">
                                    Perempuan
                                </div>

                            </div>

                        </div>


                        <!-- KK -->
                        <div class="stat-box">

                            <div class="stat-icon">

                                <i class="fa-solid fa-house"></i>

                            </div>

                            <div>

                                <div class="stat-number">
                                    <?= number_format($jumlah_kk, 0, ',', '.'); ?>
                                </div>

                                <div class="stat-label">
                                    Jumlah KK
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     GALLERY
====================================================== -->

<section class="gallery-section">

    <div class="container">


        <!-- HEADING -->
        <div class="gallery-heading">

            <div class="gallery-title">

                <div class="section-label">
                    Galeri Desa
                </div>

                <h2>
                    Kegiatan dan Dokumentasi
                </h2>

            </div>


            <a href="galeri.php"
               class="view-all">

                Lihat Semua

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>



        <!-- GALLERY -->
        <div class="gallery-grid">


            <?php foreach ($galeri as $item): ?>

                <a href="galeri.php"
                   class="gallery-card">

                    <img src="<?= htmlspecialchars($item['gambar']); ?>"
                         alt="<?= htmlspecialchars($item['judul']); ?>"
                         class="gallery-image">

                    <div class="gallery-caption">

                        <i class="fa-regular fa-image"></i>

                        <?= htmlspecialchars($item['judul']); ?>

                    </div>

                </a>

            <?php endforeach; ?>


        </div>

    </div>

</section>



<!-- =====================================================
     FOOTER
====================================================== -->

<footer>

    <div class="container">

        <div class="footer-main">


            <!-- BRAND -->
            <div class="footer-brand">

                <img src="img/logo.jpg"
                     alt="Logo Desa">

                <div>

                    <h3>
                        Sistem Informasi<br>
                        Data Penduduk
                    </h3>

                    <span>
                        kelurahan waioti
                    </span>

                </div>

            </div>


            <!-- LINKS -->
            <div class="footer-links">

                <a href="index.php">
                    Beranda
                </a>

                <a href="data-penduduk.php">
                    Data Penduduk
                </a>

                <a href="profil-desa.php">
                    Profil kelurahan
                </a>

                <a href="galeri.php">
                    Galeri
                </a>

                <a href="informasi.php">
                    Informasi
                </a>

            </div>


            <!-- SOCIAL -->
            <div class="social">

                <span>
                    Ikuti Kami
                </span>

                <a href="#">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-youtube"></i>
                </a>

            </div>

        </div>


        <!-- COPYRIGHT -->
        <div class="footer-bottom">

            © 2026 kelurahan waioti.
            Semua Hak Dilindungi.

        </div>

    </div>

</footer>



<!-- =====================================================
     JAVASCRIPT
====================================================== -->

<script>

    function toggleMenu() {

        const menu = document.getElementById('navMenu');

        menu.classList.toggle('show');

    }


    // Menutup menu mobile ketika link diklik
    document.querySelectorAll('.nav-link').forEach(function(link) {

        link.addEventListener('click', function() {

            document.getElementById('navMenu')
                .classList.remove('show');

        });

    });

</script>


</body>
</html>