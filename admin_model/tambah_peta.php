<?php


session_start();

if (!isset($_SESSION['_data_peta'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_data_peta']); 

require_once "../database/database.php";
require_once "../database/cud.php";
require_once "../database/upload_file.php";

require_once "../helper/redirect_helper.php";
require_once "../helper/csrf_token.php";


$pesans = [];

$nama_peta = htmlspecialchars(trim($_POST['namapeta']));
$wilayah = htmlspecialchars(trim($_POST['wilayah']));
$pg = htmlspecialchars(trim($_POST['pg']));
$tanggal = $_POST['tanggal'];

// Upload file terlebih dahulu
if (!isset($_FILES['png']) && !isset($_FILES['kml']) && !isset($_FILES['pdf'])) {
    $pesans[] = "File tidak ditemukan.";
} else {
    $result_upload_png = upload_file($_FILES['png'], ['png'], '../storage/png/');
    $result_upload_kml = upload_file($_FILES['kml'], ['kml'], '../storage/kml/');
    $result_upload_pdf = upload_file($_FILES['pdf'], ['pdf'], '../storage/pdf/');
    
    if (!$result_upload_png['success'] && !$result_upload_kml['success'] && !$result_upload_pdf['success']) {
        $pesans[] = $result_upload_png['error'];
        $pesans[] = $result_upload_kml['error'];
        $pesans[] = $result_upload_pdf['error'];
    } else {
        $png_file = $result_upload_png['filename'];
        $kml_file = $result_upload_kml['filename'];
        $pdf_file = $result_upload_pdf['filename'];

        if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
            $pesans[] = "CSRF token tidak valid.";
        } else {
            $conn = get_connection();
            $query = "INSERT INTO data_peta (jenis_peta, nama_peta, pg, tanggal_upload, png, kml, pdf) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $result = cud($conn, $query, "sssssss", [$wilayah, $nama_peta, $pg, $tanggal, $png_file, $kml_file, $pdf_file]);

            if (!$result['success']) {
                $pesans[] = $result['error'];
            } else {
                $pesans[] = "Data berhasil ditambah.";
                $pesans[] = "File berhasil diunggah sebagai: " . $png_file;
                $pesans[] = "File berhasil diunggah sebagai: " . $kml_file;
                $pesans[] = "File berhasil diunggah sebagai: " . $pdf_file;
            }
        }
    }
}

redirect_with("../admin/list_peta.php?j=$wilayah", ["pesans" => $pesans]);


$conn->close();
