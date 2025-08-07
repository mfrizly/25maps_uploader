<?php
session_start();

if (!isset($_SESSION['_data_marginal'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_data_marginal']); 

require_once "../database/database.php";
require_once "../database/cud.php";

require_once "../helper/redirect_helper.php";
require_once "../helper/csrf_token.php";


$pesans = [];
$nama_peta = htmlspecialchars(trim($_POST['namapeta']));
$tanggal = $_POST['tanggal'];
$id = trim($_POST['id']);

if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
    $pesans[] = "CSRF token tidak valid.";
} else {
    $conn = get_connection();
    $query = "UPDATE data_marginal SET nama_peta = ?, tanggal_upload = ? WHERE id = ?";
    $result = cud($conn, $query, "ssi", [$nama_peta, $tanggal, $id]);

    if (!$result['success']) {
        $pesans[] = $result['error'];
    } else {
        $pesans[] = "Data marginal $nama_peta berhasil di edit";
    }
}


redirect_with("../admin/marginal.php", ["pesans" => $pesans]);

$conn->close();
