<?php
$current = basename($_SERVER['PHP_SELF']);

$menus = [
    ['url' => 'dashboard.php', 'label' => 'Dashboard',        'icon' => 'bi-speedometer2'],
    ['url' => 'penduduk.php',  'label' => 'Data Penduduk',    'icon' => 'bi-people',
     'children' => ['tambah_penduduk.php', 'edit_penduduk.php', 'hapus_penduduk.php']],
    ['url' => 'kk.php',        'label' => 'Kartu Keluarga',   'icon' => 'bi-postcard'],
    ['url' => 'surat.php',     'label' => 'Layanan Surat',    'icon' => 'bi-envelope-paper'],
    ['url' => 'informasi.php', 'label' => 'Informasi',        'icon' => 'bi-megaphone'],
    ['url' => 'galeri.php',    'label' => 'Galeri',           'icon' => 'bi-images'],
    ['url' => 'profil.php',    'label' => 'Profil Kelurahan', 'icon' => 'bi-building'],
];
?>
<nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse p-0 admin-sidebar">
    <div class="position-sticky pt-3">

        <div class="text-white-50 px-3 py-2 small text-uppercase fw-bold">Menu Admin</div>

        <ul class="nav flex-column">
            <?php foreach ($menus as $m):
                // Menu otomatis disembunyikan jika file belum dibuat (anti dead-link)
                if (!file_exists(__DIR__ . '/../admin/' . $m['url'])) continue;
                $active = ($current === $m['url']) || in_array($current, $m['children'] ?? []);
            ?>
            <li class="nav-item">
                <a class="nav-link <?= $active ? 'active' : 'text-white-50' ?>"
                   href="<?= BASE_URL ?>admin/<?= $m['url'] ?>">
                    <i class="bi <?= $m['icon'] ?> me-2"></i><?= $m['label'] ?>
                </a>
            </li>
            <?php endforeach; ?>

            <li class="nav-item mt-3 border-top border-secondary pt-3">
                <a class="nav-link text-white-50" href="<?= BASE_URL ?>index.php">
                    <i class="bi bi-globe me-2"></i>Lihat Website
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="<?= BASE_URL ?>logout.php">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav>