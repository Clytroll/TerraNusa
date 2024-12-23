<?php
$db_host = 'localhost';
$db_user = 'root';  // Sesuaikan dengan username database Anda
$db_pass = '';      // Sesuaikan dengan password database Anda
<<<<<<< HEAD:includes/db.php
$db_name = 'terranusa';  // Sesuaikan dengan nama database Anda
=======
$db_name = 'terranusaofc';  // Sesuaikan dengan nama database Anda
>>>>>>> c3df19e09f84aee148ae2332d4e87f71f311b888:Authentication/backend/config/db.php

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");



?>