<?php
require_once "config.php"; // Sesuaikan ini dengan file konfigurasi koneksi database Anda

// Fungsi untuk mengambil 3 transaksi terakhir untuk akun tertentu
function getLatestTransactionsForAccount($id_akun, $conn) {
    $query = "SELECT id_akun, tanggal_transaksi, jumlah_transaksi FROM transactions WHERE id_akun = ? ORDER BY tanggal_transaksi DESC LIMIT 3";
    $result = [];

    // pembuatan statement dengan melakukan proses binding dan juga eksekusi
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $id_akun); // Mengikatkan nilai integer ke pernyataan SQL
        $stmt->execute();

        $stmt->bind_result($id_akun, $tanggal_transaksi, $jumlah_transaksi);

        while ($stmt->fetch()) {
            $result[] = [
                'id_akun' => $id_akun,
                'tanggal transaksi' => $tanggal_transaksi,
                'transaksi' => $jumlah_transaksi
            ];
        }

        $stmt->close();
        if (empty($result)) {
            echo "Belum ada riwayat transaksi";
        }
        
    }

    return $result;
}

// Mendapatkan id_akun dari parameter GET
$id_akun = isset($_GET['id_akun']) ? intval($_GET['id_akun']) : 0;

if ($id_akun > 0) {
    // Memanggil fungsi untuk mendapatkan 3 transaksi terakhir
    $latestTransactions = getLatestTransactionsForAccount($id_akun, $conn);

    // Mengembalikan hasil dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($latestTransactions);
} else {
    // Jika id_akun tidak valid atau tidak ada, berikan pesan kesalahan
    http_response_code(400);
    echo json_encode(["error" => "Parameter id_akun tidak valid atau tidak ada"]);
}
?>
