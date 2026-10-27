<?php
require_once 'config/koneksi.php';
$page_title = "Profil Kelurahan - Kelurahan Waioti";

$profil   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_profil LIMIT 1"));
$penduduk = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) t FROM tb_penduduk WHERE status_aktif='Aktif'"))['t'];
$kk       = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) t FROM tb_kartu_keluarga"))['t'];
$misi     = array_filter(explode("\n", $profil['misi']));
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="header">
    <div class="container">
        <h1><i class="bi bi-building"></i> Profil Kelurahan</h1>
        <p>Kelurahan Waioti - Kecamatan Alok Timur, Kabupaten Sikka</p>
    </div>
</section>

<section class="content">
    <div class="container">

        <div class="row g-4 mb-4">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="icon"><i class="bi bi-map-fill"></i></div>
                    <h3><?= $profil['luas_wilayah'] ?></h3>
                    <p>Luas Wilayah</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="icon"><i class="bi bi-people-fill"></i></div>
                    <h3><?= number_format($penduduk, 0, ',', '.') ?></h3>
                    <p>Jumlah Penduduk</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="icon"><i class="bi bi-postcard-fill"></i></div>
                    <h3><?= number_format($kk, 0, ',', '.') ?></h3>
                    <p>Jumlah KK</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="icon"><i class="bi bi-building-check"></i></div>
                    <h3 style="font-size:1.4rem; padding-top:12px;">Kelurahan</h3>
                    <p>Status Wilayah</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card h-100">
                    <div class="card-header"><i class="bi bi-bullseye"></i> Visi</div>
                    <div class="card-body">
                        <p class="mb-0 fst-italic">"<?= htmlspecialchars($profil['visi']) ?>"</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card h-100">
                    <div class="card-header"><i class="bi bi-list-check"></i> Misi</div>
                    <div class="card-body">
                        <ol class="mb-0">
                            <?php foreach ($misi as $m): ?>
                            <li class="mb-2"><?= htmlspecialchars(trim(preg_replace('/^\d+\./', '', $m))) ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header"><i class="bi bi-geo-alt"></i> Informasi Wilayah</div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr><th width="200">Nama Kelurahan</th><td>: <?= $profil['nama_kelurahan'] ?></td></tr>
                    <tr><th>Kecamatan</th><td>: Alok Timur</td></tr>
                    <tr><th>Kabupaten</th><td>: Sikka</td></tr>
                    <tr><th>Provinsi</th><td>: Nusa Tenggara Timur</td></tr>
                </table>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>