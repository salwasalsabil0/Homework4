<?php
include "config.php";
// Dapatkan saldo berdasarkan ID akun yang diberikan
$id_akun = $_GET['id_akun'];
$query = "SELECT saldo FROM accounts WHERE id_akun = $id_akun";
$result = $koneksi->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $saldo = $row['saldo'];
    echo json_encode(["saldo" => $saldo]);
} else {
    echo json_encode(["error" => "Gagal mengambil saldo"]);
}

// Tutup koneksi basis data
$koneksi->close();
?>
