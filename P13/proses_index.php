<?php
include 'koneksi_db.php';

$search_nama = $_GET['nama'] ?? '';
$search_email = $_GET['email'] ?? '';

$sql = "SELECT * FROM pelanggan WHERE 1=1";

if (!empty($search_nama)) {
    $search_nama = $conn->real_escape_string($search_nama);
    $sql .= " AND Nama LIKE '%$search_nama%'";
}

if (!empty($search_email)) {
    $search_email = $conn->real_escape_string($search_email);
    $sql .= " AND Email LIKE '%$search_email%'";
}

$result_pelanggan = $conn->query($sql);
?>