<!DOCTYPE html>
<htm lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>wili while</title>
</head>
<body>
    <?php
        $mahasiswa = [
            "10001" => "Andi",
            "10002" => "Budi",
            "10003" => "Citra"
            ];
        foreach ($mahasiswa as $nim => $nama) {
            echo "NIM: ". $nim .", Nama:". $nama."<br>";
        }
    ?>
</body>
</html>