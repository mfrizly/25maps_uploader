<?php

session_start();

if (!isset($_SESSION['_data_marginal'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_data_marginal']); 

require_once "../database/database.php";
require_once "../database/cud.php";
require_once "../database/read.php";
require_once "../database/upload_file.php";

require_once "../helper/redirect_helper.php";

$pesans = [];

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    $pesans[] = "ID tidak valid.";
} else {
    $conn = get_connection();

    // 1. Ambil nama file berdasarkan ID
    $query = "SELECT excel_file FROM data_marginal WHERE id = ?";
    $data = read($conn, $query, "i", [(int)$id]);

    if (!$data) {
        $pesans[] = "Data tidak ditemukan.";
    } else {
        $filename = $data[0]['excel_file'];
        $filepath = "../storage/excel/" . $filename;

        // 2. Hapus file jika ada
        if (file_exists($filepath)) {
            if (!unlink($filepath)) {
                $pesans[] = "Gagal menghapus file: $filename";
            }
        }

        // 3. Hapus dari database
        $deleteQuery = "DELETE FROM data_marginal WHERE id = ?";
        $result = cud($conn, $deleteQuery, "i", [(int)$id]);

        if ($result['success']) {
            $pesans[] = "Data dan file berhasil dihapus.";
        } else {
            $pesans[] = "Gagal menghapus data dari database.";
        }
    }
}

redirect_with("../admin/marginal.php", ["pesans" => $pesans]);
