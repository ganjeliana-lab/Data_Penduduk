<?php
require_once '../config/koneksi.php';
if (!is_login()) redirect(url('login.php'));
$page_title = "Edit Profil Kelurahan - " . APP_NAME;

$profil = query_row($koneksi, "SELECT * FROM tb_profil LIMIT 1");
if (!$profil) {
    mysqli_query($koneksi, "INSERT INTO tb_profil (visi, misi) VALUES ('', '')");
    $profil = query_row($koneksi, "SELECT * FROM tb_profil LIMIT 1");
}

$success = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama   = mysqli_real_escape_string($koneksi, trim($_POST['nama_kelurahan'] ?? ''));
    $luas   = mysqli_real_escape_string($koneksi, trim($_POST['luas_wilayah'] ?? ''));
    $visi   = mysqli_real_escape_string($koneksi, trim($_POST['visi'] ?? ''));
    $misi   = mysqli_real_escape_string($koneksi, trim($_POST['misi'] ?? ''));

    $sql = "UPDATE tb_profil SET nama_kelurahan='$nama', luas_wilayah='$luas', visi='$visi', misi='$misi' WHERE id_profil=" . $profil['id_profil'];
    if (mysqli_query($koneksi, $sql)) {
        $success = "Profil berhasil diperbarui!";
        $profil  = query_row($koneksi, "SELECT * FROM tb_profil LIMIT 1");
    }
}

include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include '../includes/sidebar.php'; ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
                <h2><i class="bi bi-building"></i> Edit Profil Kelurahan</h2>
            </div>

            <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Kelurahan</label>
                                <input type="text" name="nama_kelurahan" class="form-control" value="<?= e($profil['nama_kelurahan']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Luas Wilayah</label>
                                <input type="text" name="luas_wilayah" class="form-control" value="<?= e($profil['luas_wilayah']) ?>" placeholder="Contoh: 5,8 Km²">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Visi</label>
                                <textarea name="visi" class="form-control" rows="3"><?= e($profil['visi']) ?></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Misi <small class="text-muted">(satu baris per poin)</small></label>
                                <textarea name="misi" class="form-control" rows="6"><?= e($profil['misi']) ?></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>