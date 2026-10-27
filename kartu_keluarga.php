<?php
require_once 'config/koneksi.php';
$page_title = "Kartu Keluarga - Kelurahan Waioti";

if (isset($_GET['id'])) {
    $id      = (int)$_GET['id'];
    $kk      = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_kartu_keluarga WHERE id_kk=$id"));
    $anggota = mysqli_query($koneksi, "SELECT * FROM tb_penduduk WHERE id_kk=$id ORDER BY nama");
} else {
    $list = mysqli_query($koneksi,
        "SELECT k.*, (SELECT COUNT(*) FROM tb_penduduk p WHERE p.id_kk=k.id_kk) AS jumlah_anggota
         FROM tb_kartu_keluarga k ORDER BY k.nama_kepala");
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="header">
    <div class="container">
        <h1><i class="bi bi-postcard-fill"></i> Data Kartu Keluarga</h1>
        <p>Kelurahan Waioti</p>
    </div>
</section>

<section class="content">
    <div class="container">

        <?php if (isset($kk) && $kk): ?>
        <!-- DETAIL KK -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <span><i class="bi bi-postcard"></i> Detail Kartu Keluarga</span>
                <a href="kartu_keluarga.php" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr><th width="200">No. KK</th><td>: <strong><?= $kk['no_kk'] ?></strong></td></tr>
                    <tr><th>Kepala Keluarga</th><td>: <?= htmlspecialchars($kk['nama_kepala']) ?></td></tr>
                    <tr><th>Alamat</th><td>: <?= htmlspecialchars($kk['alamat']) ?> RT <?= $kk['rt'] ?>/RW <?= $kk['rw'] ?></td></tr>
                    <tr><th>Kelurahan/Kecamatan</th><td>: <?= $kk['desa'] ?> / <?= $kk['kecamatan'] ?></td></tr>
                    <tr><th>Kabupaten/Provinsi</th><td>: <?= $kk['kabupaten'] ?> / <?= $kk['provinsi'] ?></td></tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><i class="bi bi-people"></i> Anggota Keluarga</div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr><th>No</th><th>NIK</th><th>Nama</th><th>Hubungan</th><th>Jenis Kelamin</th><th>Pekerjaan</th></tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($a = mysqli_fetch_assoc($anggota)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $a['nik'] ?></td>
                            <td><strong><?= htmlspecialchars($a['nama']) ?></strong></td>
                            <td><?= $a['hubungan_keluarga'] ?></td>
                            <td><?= $a['jenis_kelamin'] ?></td>
                            <td><?= htmlspecialchars($a['pekerjaan']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php else: ?>
        <!-- LIST KK -->
        <div class="card">
            <div class="card-header"><i class="bi bi-table"></i> Daftar Kartu Keluarga</div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr><th>No</th><th>No. KK</th><th>Kepala Keluarga</th><th>Alamat</th><th>Jumlah Anggota</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($k = mysqli_fetch_assoc($list)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $k['no_kk'] ?></td>
                            <td><strong><?= htmlspecialchars($k['nama_kepala']) ?></strong></td>
                            <td><?= htmlspecialchars($k['alamat']) ?> RT <?= $k['rt'] ?>/RW <?= $k['rw'] ?></td>
                            <td><span class="badge bg-success"><?= $k['jumlah_anggota'] ?> orang</span></td>
                            <td>
                                <a href="kartu_keluarga.php?id=<?= $k['id_kk'] ?>" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php include 'includes/footer.php'; ?>