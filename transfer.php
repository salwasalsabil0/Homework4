<?php
// Include file konfigurasi (config.php) untuk koneksi database atau sumber data lainnya
include "config.php";

// Cek apakah ada data yang dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua kolom telah diisi
    if (isset($_POST['id_akun1']) && isset($_POST['id_akun2']) && isset($_POST['jumlah_transaksi'])) {
        // Ambil nilai dari form
        $id_akun1 = $_POST['id_akun1'];
        $id_akun2 = $_POST['id_akun2'];
        $jumlah_transaksi = $_POST['jumlah_transaksi'];

        if ($id_akun1 != '' && $id_akun2 != '' && $jumlah_transaksi != '') {
            // Selalu lakukan sanitasi input sebelum menjalankan query SQL
            $id_akun1 = intval($id_akun1);
            $id_akun2 = intval($id_akun2);
            $jumlah_transaksi = floatval($jumlah_transaksi);

            // Pastikan akun 1 memiliki saldo yang cukup
            $query = "SELECT saldo FROM accounts WHERE id_akun = $id_akun1";
            $result = $conn->query($query);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $saldo_akun1 = $row['saldo'];

                if ($saldo_akun1 >= $jumlah_transaksi) {
                    // Mulai transaksi
                    $conn->begin_transaction();

                    // Update saldo akun 1 dan akun 2 berdasarkan jumlah transaksi
                    $sql1 = "UPDATE accounts SET saldo = saldo - $jumlah_transaksi WHERE id_akun = $id_akun1";
                    $sql2 = "UPDATE accounts SET saldo = saldo + $jumlah_transaksi WHERE id_akun = $id_akun2";

                    if ($conn->query($sql1) && $conn->query($sql2)) {
                        // Jika transaksi berhasil, commit dan tampilkan pesan berhasil
                        $conn->commit();
                        echo "Transfer dari Akun $id_akun1 ke Akun $id_akun2 sejumlah $jumlah_transaksi berhasil";
                    } else {
                        // Jika ada kesalahan dalam query SQL, rollback transaksi
                        $conn->rollback();
                        echo "Transfer Gagal: Terjadi kesalahan dalam melakukan transaksi.";
                    }
                } else {
                    // Jika saldo akun 1 tidak mencukupi, tampilkan pesan kesalahan
                    echo "Transfer Gagal: Saldo Akun $id_akun1 tidak mencukupi.";
                }
            } else {
                echo "Transfer Gagal: Akun $id_akun1 tidak ditemukan.";
            }
        } else {
            // Jika ada data yang tidak diisi, tampilkan pesan kesalahan
            echo "Transfer Gagal: Semua kolom harus diisi.";
        }
    } else {
        // Jika tidak ada data POST, tampilkan pesan kesalahan
        echo "Transfer Gagal: Data yang diperlukan tidak tersedia.";
    }
} else {
    // Jika bukan metode POST, tampilkan pesan kesalahan
    echo "Transfer Gagal: Metode yang diperbolehkan hanya POST.";
}

// Tutup koneksi ke database
$conn->close();
?>
