<?php
session_start();
require_once 'config/koneksi.php';

// Statistik penduduk
$total_penduduk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penduduk WHERE status_aktif='Aktif'"))['total'];
$laki_laki = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penduduk WHERE jenis_kelamin='Laki-laki' AND status_aktif='Aktif'"))['total'];
$perempuan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penduduk WHERE jenis_kelamin='Perempuan' AND status_aktif='Aktif'"))['total'];
$jumlah_kk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_kartu_keluarga"))['total'];

// Galeri terbaru
$galeri = mysqli_query($koneksi, "SELECT * FROM tb_galeri ORDER BY created_at DESC LIMIT 4");

// Informasi terbaru
$informasi = mysqli_query($koneksi, "SELECT * FROM tb_informasi ORDER BY created_at DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Data Penduduk - Kelurahan Waioti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<!-- Hero Section -->
<section class="header">
    <div class="container">
        <h1><i class="bi bi-people-fill"></i> Sistem Informasi Data Penduduk</h1>
        <p class="lead">Kelurahan Waioti - Kecamatan Alok Timur, Kabupaten Sikka</p>
    </div>
</section>

<!-- Statistics -->
<section class="content">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="icon"><i class="bi bi-people-fill"></i></div>
                    <h3><?= number_format($total_penduduk, 0, ',', '.') ?></h3>
                    <p>Total Penduduk</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="icon"><i class="bi bi-person-fill"></i></div>
                    <h3><?= number_format($laki_laki, 0, ',', '.') ?></h3>
                    <p>Laki-laki</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="icon"><i class="bi bi-person-hearts"></i></div>
                    <h3><?= number_format($perempuan, 0, ',', '.') ?></h3>
                    <p>Perempuan</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="icon"><i class="bi bi-house-door-fill"></i></div>
                    <h3><?= number_format($jumlah_kk, 0, ',', '.') ?></h3>
                    <p>Jumlah KK</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Services -->
<section class="content pt-0">
    <div class="container">
        <h4 class="mb-4"><i class="bi bi-lightning-fill text-success"></i> Layanan Cepat</h4>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <a href="data_penduduk.php" class="card p-4 text-center h-100">
                    <i class="bi bi-people-fill text-success" style="font-size:3rem;"></i>
                    <h5 class="mt-3">Data Penduduk</h5>
                    <p class="text-muted small mb-0">Lihat data penduduk</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="data_penduduk.php?tab=kk" class="card p-4 text-center h-100">
                    <i class="bi bi-house-fill text-success" style="font-size:3rem;"></i>
                    <h5 class="mt-3">Kartu Keluarga</h5>
                    <p class="text-muted small mb-0">Data KK</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="informasi.php" class="card p-4 text-center h-100">
                    <i class="bi bi-file-earmark-text-fill text-success" style="font-size:3rem;"></i>
                    <h5 class="mt-3">Layanan Surat</h5>
                    <p class="text-muted small mb-0">Ajukan surat</p>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="informasi.php" class="card p-4 text-center h-100">
                    <i class="bi bi-info-circle-fill text-success" style="font-size:3rem;"></i>
                    <h5 class="mt-3">Informasi</h5>
                    <p class="text-muted small mb-0">Berita terbaru</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Informasi Terbaru -->
<section class="content pt-0">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="bi bi-megaphone-fill text-success"></i> Informasi Terbaru</h4>
            <a href="informasi.php" class="btn btn-outline-success btn-sm">Lihat Semua</a>
        </div>
        <div class="row g-4">
            <?php while($info = mysqli_fetch_assoc($informasi)): ?>
            <div class="col-md-4">
                <div class="info-card h-100">
                    <span class="badge"><?= $info['kategori'] ?></span>
                    <h5 class="mt-2"><?= htmlspecialchars($info['judul']) ?></h5>
                    <p class="meta"><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($info['created_at'])) ?></p>
                    <p class="text-muted"><?= substr(strip_tags($info['isi']), 0, 100) ?>...</p>
                    <a href="informasi.php?id=<?= $info['id_informasi'] ?>" class="btn btn-sm btn-outline-success">Baca Selengkapnya</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- Galeri -->
<section class="content pt-0">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4><i class="bi bi-images text-success"></i> Galeri Kegiatan</h4>
            <a href="galeri.php" class="btn btn-outline-success btn-sm">Lihat Semua</a>
        </div>
        <div class="row g-4">
            <?php while($gal = mysqli_fetch_assoc($galeri)): ?>
            <div class="col-md-3 col-6">
                <div class="gallery-item">
                    <img src="assets/img/<?= $gal['gambar'] ?>" alt="<?= $gal['judul'] ?>" onerror="this.src='assets/img/default.jpg'">
                    <div class="gallery-overlay">
                        <h6><?= $gal['judul'] ?></h6>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>