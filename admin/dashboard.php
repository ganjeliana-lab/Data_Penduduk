<?php
session_start();
require_once '../config/koneksi.php';

// Cek login
if(!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Statistik
$total_penduduk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penduduk WHERE status_aktif='Aktif'"))['total'];
$laki = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penduduk WHERE jenis_kelamin='Laki-laki' AND status_aktif='Aktif'"))['total'];
$perempuan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penduduk WHERE jenis_kelamin='Perempuan' AND status_aktif='Aktif'"))['total'];
$total_kk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_kartu_keluarga"))['total'];
$total_informasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_informasi"))['total'];
$total_galeri = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_galeri"))['total'];

// Data terbaru
$penduduk_terbaru = mysqli_query($koneksi, "SELECT * FROM tb_penduduk ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kelurahan Waioti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse p-0" style="min-height: calc(100vh - 70px);">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="dashboard.php">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="penduduk.php">
                            <i class="bi bi-people"></i> Data Penduduk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="kk.php">
                            <i class="bi bi-house-door"></i> Kartu Keluarga
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="informasi.php">
                            <i class="bi bi-megaphone"></i> Informasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="galeri.php">
                            <i class="bi bi-images"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="profil.php">
                            <i class="bi bi-building"></i> Profil Kelurahan
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a class="nav-link text-danger" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
                <span class="badge bg-success">Selamat Datang, <?= $_SESSION['nama_lengkap'] ?></span>
            </div>

            <!-- Statistics Cards -->
            <div class="row g-4 mb-4">
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
                        <h3><?= number_format($laki, 0, ',', '.') ?></h3>
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
                        <h3><?= number_format($total_kk, 0, ',', '.') ?></h3>
                        <p>Jumlah KK</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6 col-6">
                    <div class="stat-card">
                        <div class="icon" style="background: linear-gradient(135deg, #2ca8ec, #1773d5);">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>
                        <h3><?= $total_informasi ?></h3>
                        <p>Total Informasi</p>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <div class="stat-card">
                        <div class="icon" style="background: linear-gradient(135deg, #8b63e9, #6741d8);">
                            <i class="bi bi-images"></i>
                        </div>
                        <h3><?= $total_galeri ?></h3>
                        <p>Total Galeri</p>
                    </div>
                </div>
            </div>

            <!-- Data Penduduk Terbaru -->
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-clock"></i> Penduduk Terbaru Ditambahkan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Input</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                while($row = mysqli_fetch_assoc($penduduk_terbaru)): 
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nik'] ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>