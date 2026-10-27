<?php
require_once __DIR__ . '/config/koneksi.php';

$hash = password_hash('admin123', PASSWORD_DEFAULT);
$q = mysqli_query($koneksi, "UPDATE tb_users SET password='$hash' WHERE username='admin'");

if ($q && mysqli_affected_rows($koneksi) >= 0) {
    echo "✅ SUCCESS! Password admin sudah direset.<br>";
    echo "Username: <b>admin</b> | Password: <b>admin123</b><br>";
    echo "<a href='login.php'>→ Ke halaman login</a><br>";
    echo "<small style='color:red'>PENTING: hapus file reset_password.php setelah selesai!</small>";
} else {
    echo "❌ Gagal: " . mysqli_error($koneksi);
}
?>