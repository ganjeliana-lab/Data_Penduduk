<?php
session_start();
require_once '../config/koneksi.php';

if(!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$success = '';
$error = '';

// Ambil data penduduk
$query = mysqli_query($koneksi, "SELECT * FROM tb_penduduk WHERE id_penduduk=$id");
$data = mysqli_fetch_assoc($query);

if(!$data) {
    header("Location: penduduk.php");
    exit;
}

$kk_list = mysqli_query($koneksi, "SELECT * FROM tb_kartu_keluarga ORDER BY nama_kepala");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kk = mysqli_real_escape_string($koneksi, $_POST['id_kk']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $status_perkawinan = $_POST['status_perkawinan'];
    $pekerjaan = mysqli_real_escape_string($koneksi, $_POST['pekerjaan']);
    $pendidikan = mysqli_real_escape_string($koneksi, $_POST['pendidikan']);
    $hubungan_keluarga = $_POST['hubungan_keluarga'];
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    $foto = $data['foto'];
    
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        // Hapus foto lama
        if($data['foto'] != 'default.png' && file_exists('../assets/img/' . $data['foto'])) {
            unlink('../assets/img/' . $data['foto']);
        }
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto = 'penduduk_' . $data['nik'] . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/' . $foto);
    }

    $update = "UPDATE tb_penduduk SET 
               id_kk='$id_kk', nama='$nama', tempat_lahir='$tempat_lahir', 
               tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', 
               agama='$agama', status_perkawinan='$status_perkawinan', 
               pekerjaan='$pekerjaan', pendidikan='$pendidikan', 
               hubungan_keluarga='$hubungan_keluarga', alamat='$alamat', 
               rt='$rt', rw='$rw', no_hp='$no_hp', foto='$foto' 
               WHERE id_penduduk=$id";

    if(mysqli_query($koneksi, $update)) {
        $success = "Data berhasil diperbarui!";
        $query = mysqli_query($koneksi, "SELECT * FROM tb_penduduk WHERE id_penduduk=$id");
        $data = mysqli_fetch_assoc($query);
    } else {
        $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penduduk - Kelurahan Waioti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<section class="header">
    <div class="container">
        <h1><i class="bi bi-pencil-square"></i> Edit Data Penduduk</h1>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-person-gear"></i> Form Edit Penduduk - NIK: <?= $data['nik'] ?>
                    </div>
                    <div class="card-body">
                        <?php if($success): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>
                        <?php if($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Kartu Keluarga</label>
                                    <select name="id_kk" class="form-select">
                                        <option value="">-- Tanpa KK --</option>
                                        <?php while($kk = mysqli_fetch_assoc($kk_list)): ?>
                                        <option value="<?= $kk['id_kk'] ?>" <?= $data['id_kk'] == $kk['id_kk'] ? 'selected' : '' ?>>
                                            <?= $kk['no_kk'] ?> - <?= $kk['nama_kepala'] ?>
                                        </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" value="<?= $data['nik'] ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tempat Lahir *</label>
                                    <input type="text" name="tempat_lahir" class="form-control" value="<?= htmlspecialchars($data['tempat_lahir']) ?>" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Agama *</label>
                                    <select name="agama" class="form-select" required>
                                        <option value="Islam" <?= $data['agama'] == 'Islam' ? 'selected' : '' ?>>Islam</option>
                                        <option value="Kristen Protestan" <?= $data['agama'] == 'Kristen Protestan' ? 'selected' : '' ?>>Kristen Protestan</option>
                                        <option value="Katolik" <?= $data['agama'] == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                                        <option value="Hindu" <?= $data['agama'] == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                                        <option value="Buddha" <?= $data['agama'] == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                                        <option value="Konghucu" <?= $data['agama'] == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Status Perkawinan *</label>
                                    <select name="status_perkawinan" class="form-select" required>
                                        <option value="Belum Kawin" <?= $data['status_perkawinan'] == 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin</option>
                                        <option value="Kawin" <?= $data['status_perkawinan'] == 'Kawin' ? 'selected' : '' ?>>Kawin</option>
                                        <option value="Cerai Hidup" <?= $data['status_perkawinan'] == 'Cerai Hidup' ? 'selected' : '' ?>>Cerai Hidup</option>
                                        <option value="Cerai Mati" <?= $data['status_perkawinan'] == 'Cerai Mati' ? 'selected' : '' ?>>Cerai Mati</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan *</label>
                                    <input type="text" name="pekerjaan" class="form-control" value="<?= htmlspecialchars($data['pekerjaan']) ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pendidikan</label>
                                    <select name="pendidikan" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Tidak Sekolah" <?= $data['pendidikan'] == 'Tidak Sekolah' ? 'selected' : '' ?>>Tidak Sekolah</option>
                                        <option value="SD" <?= $data['pendidikan'] == 'SD' ? 'selected' : '' ?>>SD</option>
                                        <option value="SMP" <?= $data['pendidikan'] == 'SMP' ? 'selected' : '' ?>>SMP</option>
                                        <option value="SMA" <?= $data['pendidikan'] == 'SMA' ? 'selected' : '' ?>>SMA</option>
                                        <option value="D3" <?= $data['pendidikan'] == 'D3' ? 'selected' : '' ?>>D3</option>
                                        <option value="S1" <?= $data['pendidikan'] == 'S1' ? 'selected' : '' ?>>S1</option>
                                        <option value="S2" <?= $data['pendidikan'] == 'S2' ? 'selected' : '' ?>>S2</option>
                                        <option value="S3" <?= $data['pendidikan'] == 'S3' ? 'selected' : '' ?>>S3</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Hubungan Keluarga</label>
                                    <select name="hubungan_keluarga" class="form-select">
                                        <option value="Kepala Keluarga" <?= $data['hubungan_keluarga'] == 'Kepala Keluarga' ? 'selected' : '' ?>>Kepala Keluarga</option>
                                        <option value="Istri" <?= $data['hubungan_keluarga'] == 'Istri' ? 'selected' : '' ?>>Istri</option>
                                        <option value="Anak" <?= $data['hubungan_keluarga'] == 'Anak' ? 'selected' : '' ?>>Anak</option>
                                        <option value="Orang Tua" <?= $data['hubungan_keluarga'] == 'Orang Tua' ? 'selected' : '' ?>>Orang Tua</option>
                                        <option value="Famili Lain" <?= $data['hubungan_keluarga'] == 'Famili Lain' ? 'selected' : '' ?>>Famili Lain</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat *</label>
                                    <textarea name="alamat" class="form-control" rows="2" required><?= htmlspecialchars($data['alamat']) ?></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control" maxlength="3" value="<?= $data['rt'] ?>">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control" maxlength="3" value="<?= $data['rw'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. HP</label>
                                    <input type="tel" name="no_hp" class="form-control" maxlength="15" value="<?= $data['no_hp'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewImage(this, 'previewFoto')">
                                    <img id="previewFoto" src="../assets/img/<?= $data['foto'] ?>" class="img-thumbnail mt-2" style="max-height:100px;">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4 gap-2">
                                <a href="penduduk.php" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>