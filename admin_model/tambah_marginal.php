<?php


session_start();

if (!isset($_SESSION['_data_marginal'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_data_marginal']); 

require_once "../database/database.php";
require_once "../database/cud.php";
require_once "../database/upload_file.php";

require_once "../helper/redirect_helper.php";
require_once "../helper/csrf_token.php";


$pesans = [];

$nama_peta = htmlspecialchars(trim($_POST['namapeta']));
$tanggal = $_POST['tanggal'];

// Upload file terlebih dahulu
if (!isset($_FILES['excel_file'])) {
    $pesans[] = "File tidak ditemukan.";
} else {
    $result_upload = upload_file($_FILES['excel_file'], ['xls', 'xlsx'], '../storage/excel/');

    if (!$result_upload['success']) {
        $pesans[] = $result_upload['error'];
    } else {
        $excel_file = $result_upload['filename'];

        if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
            $pesans[] = "CSRF token tidak valid.";
        } else {
            $conn = get_connection();
            $query = "INSERT INTO data_marginal (nama_peta, tanggal_upload, excel_file) VALUES (?, ?, ?)";
            $result = cud($conn, $query, "sss", [$nama_peta, $tanggal, $excel_file]);

            if (!$result['success']) {
                $pesans[] = $result['error'];
            } else {
                $pesans[] = "Data berhasil ditambah.";
                $pesans[] = "File berhasil diunggah sebagai: " . $excel_file;
            }
        }
    }
}

redirect_with("../admin/marginal.php", ["pesans" => $pesans]);


$conn->close();
