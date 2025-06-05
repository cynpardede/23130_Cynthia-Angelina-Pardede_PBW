<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="witdh=device-width,  initial">
    <title>Pertemuan 11</title>
</head>
<b>
    <?php
    $hari = "Minggu";  
    switch ($hari) {
    case "Senin";
        echo "Kelas Sistem Operasi & Statistika Probabilitas";
        break;
    case "Selasa";
        echo "Kelas Rekayasa Perangkat Lunak";
        break;
    case "Rabu";
        echo "Kelas Kecerdasan Buatan";
        break;
    case "Kamis";
        echo "Kelas Embedded Intelegent System & Pemrograman Berbasis Web";
        break;
    case "Jumat";
        echo "Kelas Analisis Desain Algoritma";
        break;
    case "Sabtu";
        echo "Istirahat braderr";
        break;
    case "Minggu";
        echo "Pergi ke Gereja!";
        break;
    default:
        echo "Hari biasa";
    }
    ?>
    </form>
</body>
</html>