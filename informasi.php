<?php

$informasi = [

[
    "judul"=>"Pendataan Penduduk Tahun 2026",
    "tanggal"=>"22 September 2026",
    "kategori"=>"Pengumuman",
    "isi"=>"Pendataan penduduk akan dilaksanakan mulai tanggal 25 September 2026. Seluruh masyarakat diminta membawa KTP dan Kartu Keluarga."
],

[
    "judul"=>"Jadwal Pelayanan Kantor",
    "tanggal"=>"20 September 2026",
    "kategori"=>"Pelayanan",
    "isi"=>"Pelayanan administrasi dibuka setiap hari Senin sampai Jumat pukul 08.00 - 15.00 WITA."
],

[
    "judul"=>"Gotong Royong Bersama",
    "tanggal"=>"18 September 2026",
    "kategori"=>"Kegiatan",
    "isi"=>"Seluruh masyarakat Kelurahan Waioti diundang mengikuti kegiatan gotong royong pada hari Minggu pukul 07.00 WITA."
],

[
    "judul"=>"Pembagian Bantuan Sosial",
    "tanggal"=>"15 September 2026",
    "kategori"=>"Bantuan",
    "isi"=>"Pembagian bantuan sosial dilaksanakan di Kantor Kelurahan Waioti sesuai jadwal yang telah ditentukan."
]

];

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Informasi Kelurahan Waioti</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Inter,Arial,sans-serif;
}

body{
background:#f5f9fc;
}

.navbar{

background:white;
padding:15px 8%;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 2px 10px rgba(0,0,0,.08);

}

.logo{

font-size:22px;
font-weight:bold;
color:#0b8062;

}

.menu a{

text-decoration:none;
margin-left:25px;
color:#193452;
font-weight:600;

}

.menu a:hover{

color:#0b8062;

}

.hero{

background:linear-gradient(rgba(10,80,60,.8),rgba(10,80,60,.8)),
url("img/kantor.jpg");

background-size:cover;
background-position:center;

padding:80px 0;

text-align:center;

color:white;

}

.hero h1{

font-size:45px;

margin-bottom:10px;

}

.container{

width:90%;
max-width:1200px;
margin:auto;
padding:50px 0;

display:grid;

grid-template-columns:3fr 1fr;

gap:30px;

}

.card{

background:white;

padding:25px;

border-radius:10px;

box-shadow:0 5px 20px rgba(0,0,0,.08);

margin-bottom:25px;

}

.card h2{

color:#0b8062;

margin-bottom:10px;

}

.meta{

font-size:14px;
color:#777;
margin-bottom:15px;

}

.btn{

display:inline-block;

margin-top:15px;

padding:10px 18px;

background:#0b8062;

color:white;

text-decoration:none;

border-radius:6px;

}

.btn:hover{

background:#075a45;

}

.sidebar{

background:white;

padding:20px;

border-radius:10px;

box-shadow:0 5px 20px rgba(0,0,0,.08);

}

.sidebar h3{

margin-bottom:20px;
color:#193452;

}

.sidebar ul{

list-style:none;

}

.sidebar li{

padding:10px 0;

border-bottom:1px solid #eee;

}

.sidebar li i{

color:#0b8062;
margin-right:8px;

}

footer{

background:#193b57;

color:white;

text-align:center;

padding:25px;

margin-top:50px;

}

@media(max-width:900px){

.container{

grid-template-columns:1fr;

}

.menu{

display:none;

}

.hero h1{

font-size:35px;

}

}

</style>

</head>

<body>

<nav class="navbar">

<div class="logo">

Sistem Informasi Data Penduduk

</div>

<div class="menu">

<a href="index.php">Beranda</a>

<a href="data-penduduk.php">Data Penduduk</a>

<a href="profil-desa.php">Profil</a>

<a href="galeri.php">Galeri</a>

<a href="informasi.php" style="color:#0b8062;">Informasi</a>

</div>

</nav>

<section class="hero">

<h1>Informasi Kelurahan Waioti</h1>

<p>Berita, Pengumuman dan Informasi Terbaru</p>

</section>

<div class="container">

<div>

<?php foreach($informasi as $data){ ?>

<div class="card">

<h2><?= $data['judul']; ?></h2>

<div class="meta">

<i class="fa-solid fa-calendar"></i>

<?= $data['tanggal']; ?>

&nbsp;&nbsp;

<i class="fa-solid fa-folder"></i>

<?= $data['kategori']; ?>

</div>

<p>

<?= $data['isi']; ?>

</p>

<a href="#" class="btn">

Baca Selengkapnya

</a>

</div>

<?php } ?>

</div>

<div>

<div class="sidebar">

<h3>Kategori</h3>

<ul>

<li><i class="fa-solid fa-bullhorn"></i> Pengumuman</li>

<li><i class="fa-solid fa-users"></i> Kegiatan</li>

<li><i class="fa-solid fa-building"></i> Pelayanan</li>

<li><i class="fa-solid fa-hand-holding-heart"></i> Bantuan</li>

</ul>

</div>

</div>

</div>

<footer>

<h3>Sistem Informasi Data Penduduk</h3>

<p>Kelurahan Waioti</p>

<p>© 2026 Semua Hak Dilindungi</p>

</footer>

</body>
</html>