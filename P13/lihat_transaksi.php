<?php
include 'koneksi_db.php';

// Query untuk menampilkan data pesanan dengan nama pelanggan dan daftar buku
$query = "
    SELECT 
        Pesanan.ID AS Pesanan_ID,
        Pelanggan.Nama AS Nama_Pelanggan,
        Pesanan.Tanggal_Pesanan,
        Pesanan.Total_Harga,
        GROUP_CONCAT(Buku.Judul SEPARATOR ', ') AS Daftar_Buku
    FROM Pesanan
    JOIN Pelanggan ON Pesanan.Pelanggan_ID = Pelanggan.ID
    LEFT JOIN Detail_Pesanan ON Pesanan.ID = Detail_Pesanan.Pesanan_ID
    LEFT JOIN Buku ON Detail_Pesanan.Buku_ID = Buku.ID
    GROUP BY Pesanan.ID
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <title>Daftar Pesanan</title>
</head>
<body>
<?php include 'nav.php' ?>
<div class="container mt-4">
   <h2>Daftar Pesanan</h2>

   <!-- Tabel Daftar Pesanan -->
   <table class="table table-striped">
       <thead>
           <tr>
               <th>ID Pesanan</th>
               <th>Nama Pelanggan</th>
               <th>Buku yang Dipesan</th>
               <th>Total Harga</th>
               <th>Tanggal Pesanan</th>
           </tr>
       </thead>
       <tbody>
           <?php while ($row = $result->fetch_assoc()): ?>
           <tr>
               <td><?= $row['Pesanan_ID'] ?></td>
               <td><?= htmlspecialchars($row['Nama_Pelanggan']) ?></td>
               <td><?= htmlspecialchars($row['Daftar_Buku']) ?></td>
               <td>Rp<?= number_format($row['Total_Harga'], 2) ?></td>
               <td><?= $row['Tanggal_Pesanan'] ?></td>
           </tr>
           <?php endwhile; ?>
       </tbody>
   </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
