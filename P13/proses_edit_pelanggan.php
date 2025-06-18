<?php
include 'koneksi_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua data ada
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telepon = isset($_POST['telepon']) ? $_POST['telepon'] : '';

    // Validasi sederhana (opsional tapi berguna)
    if (empty($id) || empty($nama) || empty($alamat) || empty($email) || empty($telepon)) {
        echo "<script>alert('Semua field harus diisi.'); window.history.back();</script>";
        exit;
    }

    // Update data
    $stmt = $conn->prepare("UPDATE pelanggan SET nama = ?, alamat = ?, email = ?, telepon = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nama, $alamat, $email, $telepon, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='daftar_pelanggan.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal mengupdate data: " . $conn->error . "'); window.history.back();</script>";
    }
}
?>
