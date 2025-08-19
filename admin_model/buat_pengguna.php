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
require_once "../helper/password_validator.php";


$pesans = [];
$username = htmlspecialchars(trim($_POST['username']));
$password = trim($_POST['password_user']);




if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
    $pesans[] = "CSRF token tidak valid.";
} elseif (!validatePassword($password)) {
    $pesans[] = "Password harus 1 huruf besar, 1 huruf kecil, 1 angka, 1 simbol dan minimal 8 karakter";
} else {
    $conn = get_connection();
    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $hashed_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    $result = cud($conn, $query, "ss", [$username, $hashed_password]);

    if (!$result['success']) {
        $pesans[] = $result['error'];
    } else {
        $pesans[] = "Pengguna $username Berhasil ditambah";
    }
}


redirect_with("../admin/pengaturan_pengguna.php", ["pesans" => $pesans]);

$conn->close();
