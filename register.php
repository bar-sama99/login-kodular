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

    // [VALIDASI SERVER 1]: Cek apakah ada field yang kosong
    if (empty($user) || empty($pass) || empty($nama) || empty($email)) {
        echo "kosong";
        exit();
    }

    // [VALIDASI SERVER 2]: Cek apakah email mengandung karakter '@'
    if (strpos($email, '@') === false) {
        echo "email_salah";
        exit();
    }

    try {
        // Cek dulu apakah username sudah terdaftar atau belum
        $cek = $conn->prepare("SELECT COUNT(*) FROM tb_data2 WHERE user = :user");
        $cek->execute([':user' => $user]);
        
        if ($cek->fetchColumn() > 0) {
            echo "terdaftar";
        } else {
            // Masukkan data baru ke database jika lolos semua pengecekan
           $insert = $conn->prepare("INSERT INTO tb_data2 (user, pass, nama_lengkap, email) VALUES (:user, :pass, :nama, :email)");
            $insert->execute([
                ':user' => $user,
                ':pass' => $pass,
                ':nama' => $nama,
                ':email' => $email
            ]);

            echo "berhasil";
        }

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
} else {
    echo "metode_salah";
}
?>
