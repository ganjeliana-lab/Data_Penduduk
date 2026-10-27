<?php
session_start();
require_once '../config/koneksi.php';

if(!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$where = "WHERE 1=1";
if (!empty($search)) {
    $where .= " AND (nik LIKE '%$search%' OR nama LIKE '%$search%' OR alamat LIKE '%$search%')";
}

$query = mysqli_query($koneksi, "SELECT * FROM tb_penduduk $where ORDER BY created_at DESC");

$msg = '';
if(isset($_GET['msg'])) {
    if($_GET['msg'] == 'deleted') $msg = 'Data berhasil dihapus!';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Penduduk - Kelurahan Waioti</title>
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
                        <a class="nav-link text-white" href="dashboard.php">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="penduduk.php">
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
                <h2><i class="bi bi-people"></i> Kelola Data Penduduk</h2>
                <a href="tambah_penduduk.php" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah Penduduk
                </a>
            </div>

            <?php if($msg): ?>
            <div class="alert alert-success"><?= $msg ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari NIK atau Nama..." value="<?= htmlspecialchars($search) ?>">
                            <button type="submit" class="btn btn-success"><i class="bi bi-search"></i></button>
                            <?php if($search): ?>
                            <a href="penduduk.php" class="btn btn-secondary">Reset</a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>TTL</th>
                                    <th>Alamat</th>
                                    <th>Pekerjaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                while($row = mysqli_fetch_assoc($query)): 
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nik'] ?></td>
                                    <td><strong><?= htmlspecialchars($row['nama']) ?></strong></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= htmlspecialchars($row['tempat_lahir']) ?>, <?= date('d/m/Y', strtotime($row['tanggal_lahir'])) ?></td>
                                    <td><?= htmlspecialchars($row['alamat']) ?> RT<?= $row['rt'] ?>/RW<?= $row['rw'] ?></td>
                                    <td><?= htmlspecialchars($row['pekerjaan']) ?></td>
                                    <td>
                                        <a href="edit_penduduk.php?id=<?= $row['id_penduduk'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" onclick="confirmDelete('hapus_penduduk.php?id=<?= $row['id_penduduk'] ?>')" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
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