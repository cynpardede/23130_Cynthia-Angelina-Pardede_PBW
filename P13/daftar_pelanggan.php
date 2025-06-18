<?php
include 'koneksi_db.php';

// Proses pencarian
$searchNama = isset($_GET['nama']) ? trim($_GET['nama']) : '';
$searchEmail = isset($_GET['email']) ? trim($_GET['email']) : '';

$query = "SELECT * FROM pelanggan WHERE 1=1";
$params = [];
$types = '';

if (!empty($searchNama)) {
    $query .= " AND Nama LIKE ?";
    $params[] = "%$searchNama%";
    $types .= 's';
}

if (!empty($searchEmail)) {
    $query .= " AND Email LIKE ?";
    $params[] = "%$searchEmail%";
    $types .= 's';
}

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container mt-4">
    <h2>Daftar Pelanggan</h2>

    <!-- Form Pencarian -->
    <form class="row mb-3" method="get" action="">
        <div class="col-md-5">
            <label class="form-label">Cari Berdasarkan Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama pelanggan" value="<?= htmlspecialchars($searchNama) ?>">
        </div>
        <div class="col-md-5">
            <label class="form-label">Cari Berdasarkan Email</label>
            <input type="text" name="email" class="form-control" placeholder="Masukkan email" value="<?= htmlspecialchars($searchEmail) ?>">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Cari</button>
        </div>
    </form>

    <!-- Tombol Tambah -->
    <a href="tambah_pelanggan.php" class="btn btn-success mb-3">Tambah Pelanggan</a>

    <!-- Tabel Data -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['ID'] ?></td>
                    <td><?= htmlspecialchars($row['Nama']) ?></td>
                    <td><?= htmlspecialchars($row['Alamat']) ?></td>
                    <td><?= htmlspecialchars($row['Email']) ?></td>
                    <td><?= htmlspecialchars($row['Telepon']) ?></td>
                    <td>
                        <a href="form_edit_pelanggan.php?id=<?= $row['ID'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_pelanggan.php?id=<?= $row['ID'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus pelanggan ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center">Tidak ada data ditemukan.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
