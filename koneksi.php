<?php
// koneksi.php
// Konfigurasi Database Otomatis via Environment Variables Railway

$host     = getenv('MYSQLHOST');
$port     = getenv('MYSQLPORT');
$dbname   = getenv('MYSQLDATABASE');
$username = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');

// Membuat koneksi
try {
    $conn = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // Mode error PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mode fetch default
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Jika gagal koneksi
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
