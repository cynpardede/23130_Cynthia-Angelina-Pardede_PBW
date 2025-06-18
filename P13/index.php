<?php
session_start();

// Proteksi: hanya pengguna yang sudah login yang bisa akses
if (!isset($_SESSION['login_PerpusUNSIKA'])) {
    header("Location: login.php?message=" . urlencode("Mengakses fitur harus login dulu tsayy~"));
    exit;
}

include 'koneksi_db.php'; // pastikan file koneksi ada dan benar

// Inisialisasi variabel pencarian
$search_judul = isset($_GET['judul']) ? $_GET['judul'] : '';
$search_tahun = isset($_GET['tahun_terbit']) ? $_GET['tahun_terbit'] : '';

// Query pencarian
$sql = "SELECT * FROM buku WHERE 1";

if (!empty($search_judul)) {
    $judul = $conn->real_escape_string($search_judul);
    $sql .= " AND Judul LIKE '%$judul%'";
}

if (!empty($search_tahun)) {
    $tahun = intval($search_tahun);
    $sql .= " AND Tahun_Terbit = $tahun";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'nav.php'; ?> <!-- Navbar (pastikan file nav.php ada) -->

    <div class="container mt-4">
        <h2>Daftar Buku</h2>

        <!-- Form Pencarian -->
        <form method="get" class="row g-3 mb-4">
            <div class="col-md-5">
                <label for="judul" class="form-label">Cari Berdasarkan Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul buku"
                       value="<?php echo htmlspecialchars($search_judul); ?>">
            </div>
            <div class="col-md-3">
                <label for="tahun_terbit" class="form-label">Cari Berdasarkan Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Masukkan tahun terbit"
                       value="<?php echo htmlspecialchars($search_tahun); ?>">
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
            <div class="col-md-2 align-self-end">
                <a href="index.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <!-- Tabel Daftar Buku -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ID']; ?></td>
                            <td><?php echo htmlspecialchars($row['Judul']); ?></td>
                            <td><?php echo htmlspecialchars($row['Penulis']); ?></td>
                            <td><?php echo $row['Tahun_Terbit']; ?></td>
                            <td>Rp<?php echo number_format($row['Harga'], 2); ?></td>
                            <td>
                                <a href="form_edit.php?id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="proses_hapus.php?id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
