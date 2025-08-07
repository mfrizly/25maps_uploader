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
require_once "../helper/csrf_token.php";


$pesans = [];

$password_satu = trim($_POST['password_pertama']);
$password_kedua = trim($_POST['password_kedua']);

if ($password_satu != $password_kedua) {
    $pesans[] = "Password tidak sama";
}

if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
    $pesans[] = "CSRF token tidak valid.";
} else {
    $conn = get_connection();
    $query = "UPDATE users SET password=? WHERE username = 'admin' AND role='admin'";
    $hashed_password = password_hash($password_satu, PASSWORD_DEFAULT, ['cost' => 10]);
    $result = cud($conn, $query, "s", [$hashed_password]);

    if (!$result['success']) {
        $pesans[] = $result['error'];
    } else {
        $pesans[] = "Password Berhasil diupdate";
    }
}


redirect_with("../admin/pengaturan_pengguna.php", ["pesans" => $pesans]);

$conn->close();
