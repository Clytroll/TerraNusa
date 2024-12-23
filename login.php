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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - TerraNusa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#16423C',
                        secondary: '#6A9C89',
                        tertiary: '#C4DAD2',
                        background: '#E9EFEC',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-3xl font-bold text-primary mb-6 text-center">Masuk ke TerraNusa</h1>
        <form action="index.html" method="GET">
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary" required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Kata Sandi</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary" required>
            </div>
            <button type="submit" class="w-full bg-secondary text-white py-2 px-4 rounded-md hover:bg-secondary-dark transition duration-300">Masuk</button>
        </form>
        <p class="mt-4 text-center text-sm">
            Belum punya akun? <a href="register.html" class="text-secondary hover:underline">Daftar di sini</a>
        </p>
        <p class="mt-2 text-center text-sm">
            <a href="index.html" class="text-secondary hover:underline">Kembali ke Beranda</a>
        </p>
    </div>
</body>
</html>
