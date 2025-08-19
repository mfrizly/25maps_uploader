<?php
session_start();


if (!isset($_SESSION['_auth_access'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_auth_access']); 

require_once "csrf_token.php";
require_once "redirect_helper.php";
require_once "../database/database.php";
require_once "../database/handle_login.php";

$errors = []; 


// Cek input user

if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
    $errors[] = "CSRF token tidak valid.";
} else {
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    $conn = get_connection();
    $errors = handle_login($conn, $username, $password);
}


if (!empty($errors)) {
    redirect_with("../index.php", ['errors' => $errors]);
}
