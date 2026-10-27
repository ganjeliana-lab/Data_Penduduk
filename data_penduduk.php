<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Penduduk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    background:#f4f7fb;
    font-family:'Segoe UI',sans-serif;
}

.navbar{
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.header{
    background:#0b5d3b;
    color:white;
    padding:50px 0;
    text-align:center;
}

.content{
    padding:40px 0;
}

.card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.table th{
    background:#198754;
    color:white;
    text-align:center;
}

.table td{
    vertical-align:middle;
    text-align:center;
}

.btn-action{
    margin:2px;
}

.footer{
    margin-top:50px;
    background:#0b5d3b;
    color:white;
    text-align:center;
    padding:20px;
}

</style>

</head>
<body>

<nav class="navbar navbar-expand-lg bg-white">

<div class="container">

<a class="navbar-brand fw-bold text-success" href="index.php">
Kelurahan Waioti
</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php">Beranda</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="#">Data Penduduk</a>
</li>

<li class="nav-item">
<a class="nav-link" href="profil_kelurahan.php">Profil</a>
</li>

<li class="nav-item">
<a class="nav-link" href="galeri.php">Galeri</a>
</li>

<li class="nav-item">
<a class="nav-link" href="informasi.php">Informasi</a>
</li>

</ul>

</div>

</nav>

<section class="header">

<div class="container">

<h1>Data Penduduk Kelurahan Waioti</h1>

<p>Daftar seluruh data penduduk yang terdaftar.</p>

</div>

</section>

<section class="content">

<div class="container">

<div class="card p-4">

<div class="d-flex justify-content-between mb-3">

<h4>Daftar Penduduk</h4>

<a href="#" class="btn btn-success">
<i class="bi bi-plus-circle"></i>
Tambah Data
</a>

</div>

<div class="mb-3">

<input type="text"
class="form-control"
placeholder="Cari Nama atau NIK...">

</div>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>
<th>NIK</th>
<th>Nama</th>
<th>Jenis Kelamin</th>
<th>Alamat</th>
<th>Pekerjaan</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>1</td>
<td>5307123456789001</td>
<td>Andi Saputra</td>
<td>Laki-laki</td>
<td>RT 001/RW 001</td>
<td>Petani</td>

<td>

<a href="#" class="btn btn-info btn-sm btn-action">
<i class="bi bi-eye"></i>
</a>

<a href="#" class="btn btn-warning btn-sm btn-action">
<i class="bi bi-pencil"></i>
</a>

<a href="#" class="btn btn-danger btn-sm btn-action">
<i class="bi bi-trash"></i>
</a>

</td>

</tr>

<tr>

<td>2</td>
<td>5307123456789002</td>
<td>Maria Yosefa</td>
<td>Perempuan</td>
<td>RT 002/RW 001</td>
<td>Guru</td>

<td>

<a href="#" class="btn btn-info btn-sm btn-action">
<i class="bi bi-eye"></i>
</a>

<a href="#" class="btn btn-warning btn-sm btn-action">
<i class="bi bi-pencil"></i>
</a>

<a href="#" class="btn btn-danger btn-sm btn-action">
<i class="bi bi-trash"></i>
</a>

</td>

</tr>

<tr>

<td>3</td>
<td>5307123456789003</td>
<td>Yohanes Kleden</td>
<td>Laki-laki</td>
<td>RT 003/RW 002</td>
<td>Wiraswasta</td>

<td>

<a href="#" class="btn btn-info btn-sm btn-action">
<i class="bi bi-eye"></i>
</a>

<a href="#" class="btn btn-warning btn-sm btn-action">
<i class="bi bi-pencil"></i>
</a>

<a href="#" class="btn btn-danger btn-sm btn-action">
<i class="bi bi-trash"></i>
</a>

</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</section>

<footer class="footer">

<h5>Sistem Informasi Data Penduduk</h5>

<p>© 2026 Kelurahan Waioti</p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>