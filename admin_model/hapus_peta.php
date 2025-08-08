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

$pesans = [];

$id = $_GET['id'] ?? null;
$wilayah = $_GET['j'] ?? null;

if (!$id || !is_numeric($id)) {
    $pesans[] = "ID tidak valid.";
} else {
    $conn = get_connection();

    // 1. Ambil nama file berdasarkan ID
    $query = "SELECT png, pdf, kml FROM data_peta WHERE id = ?";
    $data = read($conn, $query, "i", [(int)$id]);

    if (!$data) {
        $pesans[] = "Data tidak ditemukan.";
    } else {
        $filename_png = $data[0]['png'];
        $filename_kml = $data[0]['kml'];
        $filename_pdf = $data[0]['pdf'];
        $filepath_png = "../storage/png/" . $filename_png;
        $filepath_kml = "../storage/kml/" . $filename_kml;
        $filepath_pdf = "../storage/pdf/" . $filename_pdf;

        // 2. Hapus file jika ada
        if (file_exists($filepath_png)) {
            if (!unlink($filepath_png)) {
                $pesans[] = "Gagal menghapus file PNG: $filename_png";
                }
        }

        if (file_exists($filepath_kml)) {
            if (!unlink($filepath_kml)) {
                $pesans[] = "Gagal menghapus file KML: $filename_kml";
            }
        }

        if (file_exists($filepath_pdf)) {
            if (!unlink($filepath_pdf)) {
                $pesans[] = "Gagal menghapus file PDF: $filename_pdf";
            }
        }


        // 3. Hapus dari database
        $deleteQuery = "DELETE FROM data_peta WHERE id = ?";
        $result = cud($conn, $deleteQuery, "i", [(int)$id]);

        if ($result['success']) {
            $pesans[] = "Data dan file berhasil dihapus.";
        } else {
            $pesans[] = "Gagal menghapus data dari database.";
        }
    }
}

redirect_with("../admin/list_peta.php?j=$wilayah", ["pesans" => $pesans]);
