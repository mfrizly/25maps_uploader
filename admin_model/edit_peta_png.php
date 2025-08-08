<?php

session_start();

if (!isset($_SESSION['_data_peta'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_data_peta']); 

require_once "../database/database.php";
require_once "../database/cud.php";
require_once "../database/read.php";
require_once "../database/upload_file.php";


require_once "../helper/redirect_helper.php";
require_once "../helper/csrf_token.php";

$pesans = [];

$id = $_POST['id'] ?? null;
$wilayah = $_POST['wilayah'] ?? null;
$csrf_token = $_POST['csrf_token'] ?? '';

if (!$id || !is_numeric($id)) {
    $pesans[] = "ID tidak valid.";
}

if (!validate_csrf_token($csrf_token)) {
    $pesans[] = "CSRF token tidak valid.";
}

if (!isset($_FILES['png']) || $_FILES['png']['error'] !== 0) {
    $pesans[] = "File png baru wajib diunggah.";
}

if (empty($pesans)) {
    $conn = get_connection();

    // Ambil data lama (nama file lama untuk dihapus)
    $data = read($conn, "SELECT png FROM data_peta WHERE id = ?", "i", [$id]);
    if (!$data) {
        $pesans[] = "Data tidak ditemukan.";
    } else {
        $oldFilename = $data[0]['png'];
        $oldPath = '../storage/png/' . $oldFilename;

        // Siapkan nama file baru
        $originalName = pathinfo($_FILES['png']['name'], PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($_FILES['png']['name'], PATHINFO_EXTENSION));
        $datePrefix = date('Ymd_His');
        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
        $newFilename = "{$datePrefix}_{$safeName}.{$extension}";

        // Upload file baru
        $uploadResult = upload_file($_FILES['png'], ['png'], '../storage/png/', $newFilename);

        if (!$uploadResult['success']) {
            $pesans[] = $uploadResult['error'];
        } else {
            // Hapus file lama (jika ada)
            if (file_exists($oldPath)) unlink($oldPath);

            // Update nama file di database
            $query = "UPDATE data_peta SET png = ? WHERE id = ?";
            $updateResult = cud($conn, $query, "si", [$newFilename, $id]);

            if ($updateResult['success']) {
                $pesans[] = "File berhasil diperbarui sebagai: {$newFilename}";
            } else {
                $pesans[] = $updateResult['error'];
            }
        }
    }
}

redirect_with("../admin/list_peta.php?j=$wilayah", ["pesans" => $pesans]);