<?php
// koneksi.php
// Konfigurasi Database
$host     = "mysql.railway.internal";
$dbname   = "railway";
$username = "root";
$password = "aFNuBUPzyXycvDNgJHwBJZELdwxcaQFp";

// Membuat koneksi
try {
    $conn = new PDO(

        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // Mode error PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mode fetch default
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Optional: pesan sukses (hapus pada production)
    // echo "Database terkoneksi";

} catch (PDOException $e) {

    // Jika gagal koneksi
    die("Koneksi database gagal: " . $e->getMessage());

}

?>

