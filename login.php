<?php
// login.php
// Aktifkan pesan error untuk membantu pelacakan
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "koneksi.php";

// REVISI 1: Mengubah $_POST menjadi $_REQUEST agar bisa dites lewat URL Browser
if(isset($_REQUEST['user']) && isset($_REQUEST['pass'])){

    $user = $_REQUEST['user'];
    $pass = $_REQUEST['pass'];

    try {
        // REVISI 2: Mengubah nama tabel menjadi 'tb_data' sesuai phpMyAdmin kamu
       $sql = "SELECT * FROM tb_data2 WHERE tb_data2_user = :user AND tb_data2_pass = :pass";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':user' => $user, ':pass' => $pass]);
        $data = $stmt->fetch();

        if($data){
            echo "berhasil";
        } else {
            echo "gagal";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    echo "Data tidak lengkap";
}
?>
