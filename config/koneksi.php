r<?php
// =============================================
// KONFIGURASI GLOBAL & DATABASE (FINAL)
// =============================================

// Session otomatis
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// URL dasar (sesuaikan nama folder di htdocs)
if (!defined('BASE_URL'))  define('BASE_URL', '/Data_Penduduk/');
if (!defined('APP_NAME'))  define('APP_NAME', 'Kelurahan Waioti');

// Koneksi database
$host     = "localhost";
$username = "root";
$password = "";
$database = "db_penduduk";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");
date_default_timezone_set('Asia/Makassar');

// =============================================
// FUNGSI BANTUAN (WAJIB ADA SEMUA)
// =============================================
if (!function_exists('is_login')) {
    function is_login() {
        return isset($_SESSION['user']);
    }
}

if (!function_exists('is_admin')) {
    function is_admin() {
        return isset($_SESSION['level']) && $_SESSION['level'] === 'admin';
    }
}

if (!function_exists('redirect')) {
    function redirect($url) {
        header("Location: " . $url);
        exit;
    }
}

if (!function_exists('url')) {
    function url($path = '') {
        return BASE_URL . ltrim($path, '/');
    }
}

if (!function_exists('e')) {
    function e($str) {
        return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('query_value')) {
    function query_value($koneksi, $query) {
        $result = mysqli_query($koneksi, $query);
        if (!$result) return 0;
        $row = mysqli_fetch_assoc($result);
        return $row ? (int)current($row) : 0;
    }
}

if (!function_exists('query_row')) {
    function query_row($koneksi, $query) {
        $result = mysqli_query($koneksi, $query);
        return $result ? mysqli_fetch_assoc($result) : null;
    }
}

if (!function_exists('query_all')) {
    function query_all($koneksi, $query) {
        $result = mysqli_query($koneksi, $query);
        if (!$result) return [];
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>