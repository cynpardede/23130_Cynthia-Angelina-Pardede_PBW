<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $user_file = 'users.txt';

    // Cek file user
    if (!file_exists($user_file)) {
        header("Location: login.php?message=Login gagal. File user tidak ditemukan.");
        exit();
    }

    $users = file($user_file, FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($saved_user, $saved_hash) = explode('|', $user);
        if ($username === $saved_user && password_verify($password, $saved_hash)) {
            // Login sukses
            $_SESSION['login_PerpusUNSIKA'] = $username;
            header("Location: index.php");
            exit();
        }
    }

    // Login gagal
    header("Location: login.php?message=Login gagal. Username atau password salah.");
    exit();
}
?>
