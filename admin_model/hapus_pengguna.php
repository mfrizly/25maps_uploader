<?php
session_start();

if (!isset($_SESSION['_pengaturan_pengguna'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_pengaturan_pengguna']); 

require_once "../database/database.php";
require_once "../database/cud.php";

require_once "../helper/redirect_helper.php";


if (!isset($_GET['id']) && !isset($_GET['username'])) {
    $pesans[] = "Data Id tidak ada";
} else {
    $id = $_GET['id'];
    $username = $_GET['username'];
}


$conn = get_connection();
$query = "DELETE FROM users WHERE id = ? AND username = ?";
$result = cud($conn, $query, "is", [$id, $username]);

if (!$result['success']) {
    $pesans[] = $result['error'];
} else {
    $pesans[] = "Pengguna berhasil dihapus";
}



redirect_with("../admin/pengaturan_pengguna.php", ["pesans" => $pesans]);

$conn->close();
