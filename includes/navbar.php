<?php
if (!defined('BASE_URL')) {
    require_once __DIR__ . '/../config/koneksi.php';
}
$current = basename($_SERVER['PHP_SELF']);

// DAFTAR SEMUA MODUL PUBLIK
$menu = [
    ['url' => 'index.php',          'label' => 'Beranda',        'icon' => 'bi-house-door'],
    ['url' => 'data_penduduk.php',  'label' => 'Data Penduduk',  'icon' => 'bi-people'],
    ['url' => 'kartu_keluarga.php', 'label' => 'Kartu Keluarga', 'icon' => 'bi-postcard'],
    ['url' => 'profil_kelurahan.php','label' => 'Profil',        'icon' => 'bi-building'],
    ['url' => 'galeri.php',         'label' => 'Galeri',         'icon' => 'bi-images'],
    ['url' => 'informasi.php',      'label' => 'Informasi',      'icon' => 'bi-info-circle'],
];
?>
<nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>index.php">
            <i class="bi bi-house-door-fill text-success"></i> Kelurahan Waioti
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <!-- MENU MODUL -->
            <ul class="navbar-nav mx-auto">
                <?php foreach ($menu as $m): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $current === $m['url'] ? 'active' : '' ?>"
                       href="<?= BASE_URL . $m['url'] ?>">
                        <i class="bi <?= $m['icon'] ?>"></i> <?= $m['label'] ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>

            <!-- MENU AUTH -->
            <ul class="navbar-nav">
                <?php if (is_login()): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['nama_lengkap']) ?>
                        <span class="badge bg-success ms-1"><?= $_SESSION['level'] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="<?= BASE_URL ?>admin/dashboard.php">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="<?= BASE_URL ?>logout.php">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="btn btn-success btn-sm px-3" href="<?= BASE_URL ?>login.php">
                        <i class="bi bi-box-arrow-in-right"></i> Login Admin
                    </a>
                </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>