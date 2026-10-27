<?php
session_start();
require_once '../config/koneksi.php';

if(!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$success = '';
$error = '';

// Ambil data KK
$kk_list = mysqli_query($koneksi, "SELECT * FROM tb_kartu_keluarga ORDER BY nama_kepala");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kk = mysqli_real_escape_string($koneksi, $_POST['id_kk']);
    $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
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

    // Validasi NIK
    $cek_nik = mysqli_query($koneksi, "SELECT nik FROM tb_penduduk WHERE nik='$nik'");
    if(mysqli_num_rows($cek_nik) > 0) {
        $error = "NIK sudah terdaftar!";
    } else {
        // Upload foto jika ada
        $foto = 'default.png';
        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $foto = 'penduduk_' . $nik . '.' . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/' . $foto);
        }

        $query = "INSERT INTO tb_penduduk (id_kk, nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, 
                  status_perkawinan, pekerjaan, pendidikan, hubungan_keluarga, alamat, rt, rw, no_hp, foto) 
                  VALUES ('$id_kk', '$nik', '$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', 
                  '$agama', '$status_perkawinan', '$pekerjaan', '$pendidikan', '$hubungan_keluarga', 
                  '$alamat', '$rt', '$rw', '$no_hp', '$foto')";

        if(mysqli_query($koneksi, $query)) {
            // Update jumlah penduduk di profil
            mysqli_query($koneksi, "UPDATE tb_profil SET jumlah_penduduk = (SELECT COUNT(*) FROM tb_penduduk WHERE status_aktif='Aktif') LIMIT 1");
            $success = "Data penduduk berhasil ditambahkan!";
        } else {
            $error = "Gagal menambahkan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penduduk - Kelurahan Waioti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<section class="header">
    <div class="container">
        <h1><i class="bi bi-person-plus-fill"></i> Tambah Data Penduduk</h1>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-person-plus"></i> Form Tambah Penduduk
                    </div>
                    <div class="card-body">
                        <?php if($success): ?>
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> <?= $success ?>
                        </div>
                        <?php endif; ?>
                        <?php if($error): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle"></i> <?= $error ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Kartu Keluarga <span class="text-danger">*</span></label>
                                    <select name="id_kk" class="form-select" required>
                                        <option value="">-- Pilih KK --</option>
                                        <?php while($kk = mysqli_fetch_assoc($kk_list)): ?>
                                        <option value="<?= $kk['id_kk'] ?>"><?= $kk['no_kk'] ?> - <?= $kk['nama_kepala'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" name="nik" class="form-control" maxlength="16" pattern="[0-9]{16}" required>
                                    <small class="text-muted">16 digit angka</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label>
                                    <select name="agama" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                    <select name="status_perkawinan" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Belum Kawin">Belum Kawin</option>
                                        <option value="Kawin">Kawin</option>
                                        <option value="Cerai Hidup">Cerai Hidup</option>
                                        <option value="Cerai Mati">Cerai Mati</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                    <input type="text" name="pekerjaan" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pendidikan</label>
                                    <select name="pendidikan" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Hubungan Keluarga</label>
                                    <select name="hubungan_keluarga" class="form-select">
                                        <option value="Kepala Keluarga">Kepala Keluarga</option>
                                        <option value="Istri">Istri</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Orang Tua">Orang Tua</option>
                                        <option value="Famili Lain">Famili Lain</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control" rows="2" required></textarea>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control" maxlength="3" placeholder="001">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control" maxlength="3" placeholder="001">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. HP</label>
                                    <input type="tel" name="no_hp" class="form-control" maxlength="15">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewImage(this, 'previewFoto')">
                                    <img id="previewFoto" src="#" class="img-thumbnail mt-2" style="display:none; max-height:100px;">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4 gap-2">
                                <a href="penduduk.php" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan
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