<?php
include 'koneksi_db.php';

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $email = trim($_POST['email']);
    $telepon = trim($_POST['telepon']);

    if ($nama && $alamat && $email && $telepon) {
        $stmt = $conn->prepare("INSERT INTO pelanggan (Nama, Alamat, Email, Telepon) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $alamat, $email, $telepon);

        if ($stmt->execute()) {
            echo "<script>
                alert('Pelanggan berhasil ditambahkan!');
                window.location.href = 'daftar_pelanggan.php';
            </script>";
            exit;
        } else {
            $error = $stmt->error;
        }
    } else {
        $error = "Semua field harus diisi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- ✅ Gunakan navbar dari file nav.php -->
<?php include 'nav.php'; ?>

<div class="container mt-4">
    <h2>Tambah Pelanggan</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Pelanggan</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
