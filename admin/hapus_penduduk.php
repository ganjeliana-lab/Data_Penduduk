<?php
session_start();
require_once '../config/koneksi.php';

if(!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data untuk hapus foto
$query = mysqli_query($koneksi, "SELECT foto FROM tb_penduduk WHERE id_penduduk=$id");
$data = mysqli_fetch_assoc($query);

if($data) {
    // Hapus foto jika bukan default
    if($data['foto'] != 'default.png' && file_exists('../assets/img/' . $data['foto'])) {
        unlink('../assets/img/' . $data['foto']);
    }

    // Hapus data
    mysqli_query($koneksi, "DELETE FROM tb_penduduk WHERE id_penduduk=$id");
    
    // Update jumlah penduduk
    mysqli_query($koneksi, "UPDATE tb_profil SET jumlah_penduduk = (SELECT COUNT(*) FROM tb_penduduk WHERE status_aktif='Aktif') LIMIT 1");
}

header("Location: penduduk.php?msg=deleted");
exit;
?>