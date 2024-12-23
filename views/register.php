<?php
// Include konfigurasi koneksi database
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validasi apakah kata sandi dan konfirmasi kata sandi cocok
    if ($password !== $confirmPassword) {
        echo "Kata sandi tidak cocok.";
        exit;
    }

    // Cek apakah email sudah terdaftar
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email sudah terdaftar.";
        exit;
    }

    // Simpan data ke database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil! <a href='login.html'>Masuk di sini</a>";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}
?>
