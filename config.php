<?php
$host = 'localhost';
$db   = 'db_dashboard'; // Ganti dengan nama database kamu
$user = 'root';          // Ganti jika pakai username lain
$pass = '';              // Ganti jika ada password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Untuk debugging
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Hasil fetch berupa array asosiatif
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Gunakan prepared statement asli
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit;
}
