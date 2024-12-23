<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validasi kecocokan kata sandi
    if ($password !== $confirmPassword) {
        echo "Kata sandi tidak cocok.";
        exit;
    }

    // Hash kata sandi
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // SQL untuk menambahkan data
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
