<?php
require_once 'config/koneksi.php';
$page_title = "Informasi - Kelurahan Waioti";

$detail = null;
if (isset($_GET['id'])) {
    $id     = (int)$_GET['id'];
    $detail = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_informasi WHERE id_informasi=$id"));
}

$kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($koneksi, $_GET['kategori']) : '';
$where    = $kategori ? "WHERE kategori='" . $kategori . "'" : "";
$list     = mysqli_query($koneksi, "SELECT * FROM tb_informasi $where ORDER BY created_at DESC");
$katlist  = mysqli_query($koneksi, "SELECT kategori, COUNT(*) total FROM tb_informasi GROUP BY kategori");
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="header">
    <div class="container">
        <h1><i class="bi bi-megaphone-fill"></i> Informasi</h1>
        <p>Berita, pengumuman dan kegiatan Kelurahan Waioti</p>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row g-4">

            <!-- KOLOM KONTEN -->
            <div class="col-lg-8">

                <?php if ($detail): ?>
                <!-- DETAIL BERITA -->
                <div class="card">
                    <div class="card-body p-4">
                        <a href="informasi.php" class="btn btn-sm btn-outline-success mb-3">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <span class="badge bg-success"><?= $detail['kategori'] ?></span>
                        <h3 class="mt-2"><?= htmlspecialchars($detail['judul']) ?></h3>
                        <p class="text-muted small">
                            <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($detail['created_at'])) ?>
                            &nbsp;|&nbsp; <i class="bi bi-person"></i> <?= htmlspecialchars($detail['penulis']) ?>
                        </p>
                        <hr>
                        <p style="white-space: pre-line;"><?= htmlspecialchars($detail['isi']) ?></p>
                    </div>
                </div>

                <?php else: ?>
                <!-- LIST BERITA -->
                <?php while ($info = mysqli_fetch_assoc($list)): ?>
                <div class="info-card">
                    <span class="badge"><?= $info['kategori'] ?></span>
                    <h4 class="mt-2"><?= htmlspecialchars($info['judul']) ?></h4>
                    <p class="meta">
                        <i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($info['created_at'])) ?>
                        | <i class="bi bi-person"></i> <?= htmlspecialchars($info['penulis']) ?>
                    </p>
                    <p class="text-muted"><?= substr(strip_tags($info['isi']), 0, 150) ?>...</p>
                    <a href="informasi.php?id=<?= $info['id_informasi'] ?>" class="btn btn-sm btn-success">
                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>

            </div>

            <!-- SIDEBAR KATEGORI -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header"><i class="bi bi-tags"></i> Kategori</div>
                    <div class="list-group list-group-flush">
                        <?php while ($k = mysqli_fetch_assoc($katlist)): ?>
                        <a href="informasi.php?kategori=<?= urlencode($k['kategori']) ?>"
                           class="list-group-item list-group-item-action d-flex justify-content-between">
                            <span><?= $k['kategori'] ?></span>
                            <span class="badge bg-success"><?= $k['total'] ?></span>
                        </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>