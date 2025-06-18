<?php
include 'koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $stmt = $conn->prepare("INSERT INTO pelanggan (Nama, Alamat, Email, Telepon) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $alamat, $email, $telepon);

    if ($stmt->execute()) {
        echo "<script>
            alert('Pelanggan berhasil ditambahkan!');
            window.location.href = 'tambah_pelanggan.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan pelanggan: " . addslashes($stmt->error) . "');
            window.location.href = 'tambah_pelanggan.php';
        </script>";
    }
}
?>