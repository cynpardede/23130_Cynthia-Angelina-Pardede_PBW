<?php
$nama = $_POST['nama'];
$email = $_POST['email'];
$nilai = $_POST['nilai'];

echo "Nama: " . $nama . "<br>";
echo "Email: " . $email . "<br>";
echo "Nilai: " . $nilai . "<br>";

if ($nilai >= 80) {
    echo "Keterangan: Nilai Anda tinggi.";
} elseif ($nilai >= 70) {
    echo "Keterangan: Nilai Anda cukup.";
} else {
    echo "Keterangan: Nilai Anda perlu ditingkatkan.";
}
?>