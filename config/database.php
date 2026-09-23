<?php
// config/database.php

$host = 'localhost';
$dbname = 'rs_db';
$username = 'root';
$password = ''; // Sesuaikan dengan password database Anda

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
