<?php
include "config.php"; // Mengimpor file konfigurasi yang berisi koneksi basis data

// Dapatkan saldo berdasarkan ID akun yang diberikan
if (isset($_GET['id_akun'])) {

    $id_akun = $_GET['id_akun']; // Mengambil ID akun dari parameter GET
    $query = "SELECT saldo FROM accounts WHERE id_akun = $id_akun"; // Membuat kueri SQL untuk mengambil saldo dari tabel 'accounts' berdasarkan ID akun
    $result = $conn->query($query); // Menjalankan kueri SQL dan menyimpan hasilnya dalam variabel 'result'

// Memeriksa apakah kueri berhasil dijalankan
    if ($result) {
    // Jika berhasil, mengambil satu baris data hasil kueri dan menyimpannya dalam variabel 'row'
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $saldo = $row['saldo'];
            echo json_encode(["saldo" => $saldo]);
        } else {
            // Jika kueri gagal dijalankan, mengembalikan pesan error dalam format JSON
            echo json_encode(["error" => "ID Akun tidak ditemukan"]);
        }
    } 
}

// Menutup koneksi basis data
$conn->close();
?>
