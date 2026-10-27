<?php
require_once 'config/koneksi.php';
$page_title = "Galeri - Kelurahan Waioti";

$kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($koneksi, $_GET['kategori']) : '';
$where    = $kategori ? "WHERE kategori='" . $kategori . "'" : "";

$galeri  = mysqli_query($koneksi, "SELECT * FROM tb_galeri $where ORDER BY created_at DESC");
$katlist = mysqli_query($koneksi, "SELECT DISTINCT kategori FROM tb_galeri ORDER BY kategori");
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="header">
    <div class="container">
        <h1><i class="bi bi-images"></i> Galeri Kegiatan</h1>
        <p>Dokumentasi kegiatan dan pelayanan masyarakat</p>
    </div>
</section>

<section class="content">
    <div class="container">

        <!-- Filter Kategori -->
        <div class="mb-4">
            <a href="galeri.php" class="btn btn-sm <?= !$kategori ? 'btn-success' : 'btn-outline-success' ?>">Semua</a>
            <?php while ($k = mysqli_fetch_assoc($katlist)): ?>
            <a href="galeri.php?kategori=<?= urlencode($k['kategori']) ?>"
               class="btn btn-sm <?= $kategori === $k['kategori'] ? 'btn-success' : 'btn-outline-success' ?>">
                <?= $k['kategori'] ?>
            </a>
            <?php endwhile; ?>
        </div>

        <div class="row g-4">
            <?php if (mysqli_num_rows($galeri) == 0): ?>
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada foto pada kategori ini.</div>
            </div>
            <?php endif; ?>

            <?php while ($g = mysqli_fetch_assoc($galeri)): ?>
            <div class="col-md-4 col-6">
                <div class="gallery-item">
                    <img src="<?= BASE_URL ?>assets/img/<?= $g['gambar'] ?>"
                         alt="<?= htmlspecialchars($g['judul']) ?>"
                         onerror="this.src='<?= BASE_URL ?>assets/img/default.jpg'">
                    <div class="gallery-overlay">
                        <span class="badge bg-success mb-1"><?= $g['kategori'] ?></span>
                        <h6 class="mb-0"><?= htmlspecialchars($g['judul']) ?></h6>
                        <small><?= htmlspecialchars($g['keterangan']) ?></small>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>