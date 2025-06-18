<?php
include 'koneksi_db.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='daftar_pelanggan.php';</script>";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM pelanggan WHERE ID = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "<script>alert('Data pelanggan tidak ditemukan!'); window.location.href='daftar_pelanggan.php';</script>";
    exit;
}

$pelanggan = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <title>Edit Data Pelanggan</title>
</head>
<body>
<div class="container mt-5">
    <h2>Edit Data Pelanggan</h2>
    <form action="proses_edit_pelanggan.php" method="post">
        <input type="hidden" name="id" value="<?php echo $pelanggan['ID']; ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo htmlspecialchars($pelanggan['Nama']); ?>">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required value="<?php echo htmlspecialchars($pelanggan['Alamat']); ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($pelanggan['Email']); ?>">
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required value="<?php echo htmlspecialchars($pelanggan['Telepon']); ?>">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="daftar_pelanggan.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
