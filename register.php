<?php
// register.php
include 'koneksi.php';

// Pastikan data dikirim menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Ambil data yang dikirim oleh Kodular
    $user  = isset($_POST['user']) ? trim($_POST['user']) : '';
    $pass  = isset($_POST['pass']) ? trim($_POST['pass']) : '';
    $nama  = isset($_POST['nama_lengkap']) ? trim($_POST['nama_lengkap']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Cek apakah ada field yang kosong
    if (empty($user) || empty($pass) || empty($nama) || empty($email)) {
        echo "kosong";
        exit();
    }

    try {
        // 1. Cek dulu apakah username sudah terdaftar atau belum
        $cek = $conn->prepare("SELECT COUNT(*) FROM tb_data WHERE user = :user");
        $cek->execute([':user' => $user]);
        
        if ($cek->fetchColumn() > 0) {
            // Jika username sudah ada di database
            echo "terdaftar";
        } else {
            // 2. Jika belum ada, masukkan data baru ke database
            // Catatan: Untuk keamanan produksi, disarankan menggunakan password_hash(), 
            // namun kita pakai text biasa dulu agar match dengan sistem login awalmu.
            $insert = $conn->prepare("INSERT INTO tb_data (user, pass, nama_lengkap, email) VALUES (:user, :pass, :nama, :email)");
            $insert->execute([
                ':user' => $user,
                ':pass' => $pass,
                ':nama' => $nama,
                ':email' => $email
            ]);

            // Jika berhasil disimpan
            echo "berhasil";
        }

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
} else {
    echo "metode_salah";
}
?>
