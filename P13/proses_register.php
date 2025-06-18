<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $konfirmasi = trim($_POST['konfirmasi_password']);
    $user_file = 'users.txt';

    // Validasi input
    if ($username === '' || $password === '' || $konfirmasi === '') {
        header("Location: register.php?message=Semua field wajib diisi.");
        exit();
    }

    // Cek kesamaan password
    if ($password !== $konfirmasi) {
        header("Location: register.php?message=Password tidak cocok.");
        exit();
    }

    // Hindari karakter yang mengganggu format
    if (strpos($username, '|') !== false || strpos($password, '|') !== false) {
        header("Location: register.php?message=Input tidak boleh mengandung karakter '|'");
        exit();
    }

    // Cek jika username sudah digunakan
    $users = file_exists($user_file) ? file($user_file, FILE_IGNORE_NEW_LINES) : [];
    foreach ($users as $user) {
        list($saved_user,) = explode('|', $user);
        if ($username === $saved_user) {
            header("Location: register.php?message=Username sudah digunakan.");
            exit();
        }
    }

    // Simpan dengan password terenkripsi
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    file_put_contents($user_file, "$username|$hashed_password\n", FILE_APPEND);

    header("Location: login.php?message=Akun berhasil dibuat. Silakan login.");
    exit();
}
?>