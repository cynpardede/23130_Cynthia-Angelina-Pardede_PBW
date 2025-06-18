<?php
include 'koneksi_db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus dulu dari tabel detail_pesanan (jika foreign key tidak cascade)
    $stmt1 = $conn->prepare("DELETE FROM detail_pesanan WHERE Buku_ID = ?");
    $stmt1->bind_param("i", $id);
    $stmt1->execute(); // abaikan jika tidak ada, supaya tetap bisa lanjut
    $stmt1->close();

    // Sekarang hapus dari tabel Buku
    $stmt2 = $conn->prepare("DELETE FROM Buku WHERE ID = ?");
    $stmt2->bind_param("i", $id);

    if ($stmt2->execute()) {
        echo "<script>alert('Data buku berhasil dihapus'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus buku: " . addslashes($stmt2->error) . "'); window.location='index.php';</script>";
    }

    $stmt2->close();
} else {
    echo "<script>alert('ID tidak valid'); window.location='index.php';</script>";
}

$conn->close();
?>
