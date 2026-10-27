<?php
// ============================================
// LOGIN.PHP - VERSI STANDALONE (ANTI ERROR)
// ============================================

// 1. Inisialisasi session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Konfigurasi dasar (didefinisikan langsung)
define('BASE_URL', '/Data_Penduduk/');
define('APP_NAME', 'Kelurahan Waioti');

// 3. Fungsi helper (fallback)
if (!function_exists('url')) {
    function url($path = '') {
        return BASE_URL . ltrim($path, '/');
    }
}
if (!function_exists('redirect')) {
    function redirect($url) {
        header("Location: " . $url);
        exit;
    }
}
if (!function_exists('is_login')) {
    function is_login() {
        return isset($_SESSION['user']);
    }
}

// 4. Koneksi database
$host     = "localhost";
$db_user  = "root";
$db_pass  = "";
$database = "db_penduduk";

$koneksi = @mysqli_connect($host, $db_user, $db_pass, $database);
$db_ok = (bool) $koneksi;

// 5. Jika sudah login, lempar ke dashboard
if (is_login()) {
    redirect(url('admin/dashboard.php'));
}

// 6. Proses login
$error = '';
$username_old = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $db_ok) {
    $username_old = trim($_POST['username'] ?? '');
    $password     = $_POST['password'] ?? '';

    if ($username_old === '' || $password === '') {
        $error = 'Username dan password wajib diisi!';
    } else {
        $u = mysqli_real_escape_string($koneksi, $username_old);
        $q = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE username='$u' LIMIT 1");

        if ($q && mysqli_num_rows($q) > 0) {
            $user = mysqli_fetch_assoc($q);

            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user']         = $user['id_user'];
                $_SESSION['username']     = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                $_SESSION['level']        = $user['level'];
                redirect(url('admin/dashboard.php'));
            } else {
                $error = 'Password salah!';
            }
        } else {
            $error = 'Username tidak ditemukan!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: linear-gradient(135deg, #0b5d3b 0%, #193452 100%); min-height: 100vh; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .login-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .login-card { background: #fff; border-radius: 15px; padding: 40px; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,.3); }
        .login-card h4 { color: #193452; }
        .btn-success { background: #0b5d3b; border-color: #0b5d3b; }
        .btn-success:hover { background: #075a45; border-color: #075a45; }
        .text-success { color: #0b5d3b !important; }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">

        <div class="text-center mb-4">
            <i class="bi bi-shield-lock-fill text-success" style="font-size:4rem;"></i>
            <h4 class="mt-3">Login Admin</h4>
            <p class="text-muted mb-0">Sistem Informasi Data Penduduk</p>
            <small class="text-muted"><?= APP_NAME ?></small>
        </div>

        <?php if (!$db_ok): ?>
        <div class="alert alert-warning py-2">
            <i class="bi bi-exclamation-triangle"></i>
            <strong>Koneksi database gagal!</strong><br>
            <small>Pastikan database <code>db_penduduk</code> sudah dibuat di phpMyAdmin dan file SQL sudah diimport.</small>
        </div>
        <?php endif; ?>

        <?php if ($error !== ''): ?>
        <div class="alert alert-danger py-2">
            <i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control"
                           value="<?= htmlspecialchars($username_old) ?>"
                           placeholder="Masukkan username" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control"
                           placeholder="Masukkan password" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg" <?= !$db_ok ? 'disabled' : '' ?>>
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="index.php" class="text-muted">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>

        <div class="alert alert-info mt-3 small mb-0">
            <strong>Demo Login:</strong><br>
            Username: <code>admin</code> &nbsp;|&nbsp; Password: <code>admin123</code>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>