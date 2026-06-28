<?php
// koneksi.php
// Konfigurasi Database

// ⚠️ GANTI VALUE DI BAWAH INI SESUAI YANG ADA DI TAB VARIABLES MYSQL KAMU!
$host     = "mysql.railway.internal";     // Ambil nilai dari MYSQLHOST (Contoh bentuknya: 'mysql.railway.internal' atau string publik dari Railway)
$port     = "3306";     // Ambil nilai dari MYSQLPORT (Contoh: 3306 atau angka acak lainnya)
$dbname   = "railway";                     // Tetap 'railway' jika sesuai di database
$username = "root";                        // Ambil nilai dari MYSQLUSER
$password = "aFNuBUPzyXycvDNgJHwBJZELdwxcaQFp"; // Password kamu sudah benar

// Membuat koneksi
try {
    // Kita tambahkan parameter port di dalam string koneksi PDO
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
