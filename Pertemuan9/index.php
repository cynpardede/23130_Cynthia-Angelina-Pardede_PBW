<?php
//Penyimpanan data Variabel 
$barang = [
    "nama" => "Keyboard",
    "harga_satuan" => 150000,
    "jumlah_beli" => 2,
];

$total_harga_sebelum_pajak = $barang["harga_satuan"] * $barang["jumlah_beli"];

$pajak = 0.1; //yang artinya 10%
$jumlah_pajak = $total_harga_sebelum_pajak * $pajak;

// Penghitungan Total Pembayaran
$total_bayar = $total_harga_sebelum_pajak + $jumlah_pajak;

//Output hasil
echo "<h2>Perhitungan Total Pembelian (Dengan Array)</h2>";
echo "<hr>";
echo "Nama Barang: " . $barang["nama"] . "<br>";
echo "Harga Satuan: Rp " . number_format($barang["harga_satuan"], 0, ",", ".") . "<br>";
echo "Jumlah Beli: " . $barang["jumlah_beli"] . "<br>";
echo "Total Harga (Sebelum Pajak): Rp " . number_format($total_harga_sebelum_pajak, 0, ",", ".") . "<br>";
echo "Pajak (10%): Rp " . number_format($jumlah_pajak, 0, ",", ".") . "<br>";
echo "Total Bayar: Rp " . number_format($total_bayar, 0, ",", ".") . "<br>";
?>