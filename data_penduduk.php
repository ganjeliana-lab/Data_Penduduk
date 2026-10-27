<?php
session_start();
require_once 'config/koneksi.php';

// Pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$where = "WHERE status_aktif='Aktif'";
if (!empty($search)) {
    $where .= " AND (nik LIKE '%$search%' OR nama LIKE '%$search%' OR alamat LIKE '%$search%')";
}

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Total data
$total_result = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_penduduk $where"))['total'];
$total_pages = ceil($total_result / $limit);

// Data penduduk
$query = "SELECT * FROM tb_penduduk $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$penduduk = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk - Kelurahan Waioti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<section class="header">
    <div class="container">
        <h1><i class="bi bi-people-fill"></i> Data Penduduk</h1>
        <p>Kelurahan Waioti</p>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-table"></i> Daftar Penduduk</span>
                <?php if(isset($_SESSION['user'])): ?>
                <a href="admin/tambah_penduduk.php" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Data
                </a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari NIK, Nama, atau Alamat..." value="<?= htmlspecialchars($search) ?>">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <?php if(!empty($search)): ?>
                        <a href="data_penduduk.php" class="btn btn-secondary">Reset</a>
                        <?php endif; ?>
                    </div>
                </form>

                <!-- Info -->
                <p class="text-muted">Menampilkan <strong><?= mysqli_num_rows($penduduk) ?></strong> dari <strong><?= $total_result ?></strong> data penduduk</p>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tablePenduduk">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>Pekerjaan</th>
                                <?php if(isset($_SESSION['user'])): ?>
                                <th width="120">Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = $offset + 1;
                            while($row = mysqli_fetch_assoc($penduduk)): 
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nik'] ?></td>
                                <td><strong><?= htmlspecialchars($row['nama']) ?></strong></td>
                                <td>
                                    <?php if($row['jenis_kelamin'] == 'Laki-laki'): ?>
                                    <span class="badge bg-primary">L</span>
                                    <?php else: ?>
                                    <span class="badge bg-danger">P</span>
                                    <?php endif; ?>
                                    <?= $row['jenis_kelamin'] ?>
                                </td>
                                <td><?= htmlspecialchars($row['tempat_lahir']) ?>, <?= date('d/m/Y', strtotime($row['tanggal_lahir'])) ?></td>
                                <td><?= htmlspecialchars($row['alamat']) ?> RT <?= $row['rt'] ?>/RW <?= $row['rw'] ?></td>
                                <td><?= htmlspecialchars($row['pekerjaan']) ?></td>
                                <?php if(isset($_SESSION['user'])): ?>
                                <td>
                                    <a href="admin/edit_penduduk.php?id=<?= $row['id_penduduk'] ?>" class="btn btn-warning btn-action btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="#" onclick="confirmDelete('admin/hapus_penduduk.php?id=<?= $row['id_penduduk'] ?>')" class="btn btn-danger btn-action btn-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if($total_pages > 1): ?>
                <nav>
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page-1 ?>&search=<?= $search ?>">Prev</a>
                        </li>
                        <?php for($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>
                        <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page+1 ?>&search=<?= $search ?>">Next</a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>