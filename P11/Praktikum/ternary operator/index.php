<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ternary Operator</title>
</head>
<body>
    <?php
        $umur = 17; //ikuti aturan indo ktp 17 tahun 
        $status = ($umur >= 17) ? "Dewasa" : "Anak-anak";
        echo $status;
    ?>
</body>
</html>