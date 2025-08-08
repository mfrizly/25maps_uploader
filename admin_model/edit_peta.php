<?php
session_start();

if (!isset($_SESSION['_data_peta'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_data_peta']); 

require_once "../database/database.php";
require_once "../database/cud.php";

require_once "../helper/redirect_helper.php";
require_once "../helper/csrf_token.php";


$pesans = [];
$nama_peta = htmlspecialchars(trim($_POST['namapeta']));
$jenis_peta = htmlspecialchars(trim($_POST['wilayah']));
$pg = htmlspecialchars(trim($_POST['pg']));
$tanggal = $_POST['tanggal'];
$id = trim($_POST['id']);

if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
    $pesans[] = "CSRF token tidak valid.";
} else {
    $conn = get_connection();
    $query = "UPDATE data_peta SET nama_peta = ?, tanggal_upload = ?, jenis_peta = ?, pg = ? WHERE id = ?";
    $result = cud($conn, $query, "ssssi", [$nama_peta, $tanggal, $jenis_peta, $pg, $id]);

    if (!$result['success']) {
        $pesans[] = $result['error'];
    } else {
        $pesans[] = "Data peta $nama_peta berhasil di edit";
    }
}


redirect_with("../admin/list_peta.php?j=$jenis_peta", ["pesans" => $pesans]);

$conn->close();
