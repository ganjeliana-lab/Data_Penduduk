<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Galeri Kelurahan Waioti</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{
    font-family:'Segoe UI',sans-serif;
    background:#f5f5f5;
}

.navbar{
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.hero{
    background:#0b5d3b;
    color:white;
    padding:70px 0;
    text-align:center;
}

.hero h1{
    font-size:45px;
    font-weight:bold;
}

.galeri{
    padding:70px 0;
}

.card{
    border:none;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
    transition:.3s;
}

.card:hover{
    transform:translateY(-8px);
}

.card img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.card-body{
    text-align:center;
}

.footer{
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

<a class="nav-link active" href="galeri.php">Galeri</a>

</li>

</ul>

</div>

</nav>

<section class="hero">

<div class="container">

<h1>Galeri Kelurahan Waioti</h1>

<p>Dokumentasi kegiatan dan pelayanan masyarakat</p>

</div>

</section>

<section class="galeri">

<div class="container">

<div class="row g-4">

<div class="col-md-4">

<div class="card">

<img src="img/galeri1.jpg">

<div class="card-body">

<h5>Gotong Royong</h5>

<p>Kegiatan kerja bakti masyarakat.</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<img src="img/galeri2.jpg">

<div class="card-body">

<h5>Pelayanan Kantor</h5>

<p>Pelayanan administrasi penduduk.</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<img src="img/galeri3.jpg">

<div class="card-body">

<h5>Posyandu</h5>

<p>Kegiatan kesehatan masyarakat.</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<img src="img/galeri4.jpg">

<div class="card-body">

<h5>Musyawarah</h5>

<p>Rapat bersama warga.</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<img src="img/galeri5.jpg">

<div class="card-body">

<h5>Peringatan Hari Besar</h5>

<p>Kegiatan bersama masyarakat.</p>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<img src="img/galeri6.jpg">

<div class="card-body">

<h5>Kerja Bakti</h5>

<p>Membersihkan lingkungan kelurahan.</p>

</div>

</div>

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