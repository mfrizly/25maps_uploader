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
require_once "../helper/csrf_token.php";

$pesans = [];

$id = $_POST['id'] ?? null;
$csrf_token = $_POST['csrf_token'] ?? '';

if (!$id || !is_numeric($id)) {
    $pesans[] = "ID tidak valid.";
}

if (!validate_csrf_token($csrf_token)) {
    $pesans[] = "CSRF token tidak valid.";
}

if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] !== 0) {
    $pesans[] = "File Excel baru wajib diunggah.";
}

if (empty($pesans)) {
    $conn = get_connection();

    // Ambil data lama (nama file lama untuk dihapus)
    $data = read($conn, "SELECT excel_file FROM data_marginal WHERE id = ?", "i", [$id]);
    if (!$data) {
        $pesans[] = "Data tidak ditemukan.";
    } else {
        $oldFilename = $data[0]['excel_file'];
        $oldPath = '../storage/excel/' . $oldFilename;

        // Siapkan nama file baru
        $originalName = pathinfo($_FILES['excel_file']['name'], PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION));
        $datePrefix = date('Ymd_His');
        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
        $newFilename = "{$datePrefix}_{$safeName}.{$extension}";

        // Upload file baru
        $uploadResult = upload_file($_FILES['excel_file'], ['xls', 'xlsx'], '../storage/excel/', $newFilename);

        if (!$uploadResult['success']) {
            $pesans[] = $uploadResult['error'];
        } else {
            // Hapus file lama (jika ada)
            if (file_exists($oldPath)) unlink($oldPath);

            // Update nama file di database
            $query = "UPDATE data_marginal SET excel_file = ? WHERE id = ?";
            $updateResult = cud($conn, $query, "si", [$newFilename, $id]);

            if ($updateResult['success']) {
                $pesans[] = "File berhasil diperbarui sebagai: {$newFilename}";
            } else {
                $pesans[] = $updateResult['error'];
            }
        }
    }
}

redirect_with("../admin/marginal.php", ["pesans" => $pesans]);