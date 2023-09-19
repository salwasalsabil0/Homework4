<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "bank73";

// Membuat koneksi ke database
$conn = new mysqli($hostname, $username, $password, $database);

// Memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Gagal Koneksi ke Database: " . $conn->connect_error);
} else {
    echo "Database Success";
}
?>
