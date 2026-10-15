<?php
// config/database.php

$host = '127.0.0.1';
$dbname = 'u245817713_RumahSakit_V';
$username = 'u245817713_admin_rs';
$password = 'RumahSakit1234!@';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Enable emulated prepares for MySQL
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {
    // Pada environment production, jangan tampilkan error detail ke user
    die("Koneksi Database Gagal. Pastikan database '$dbname' sudah dibuat. Error: " . $e->getMessage());
}
?>

