<?php
session_start();

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}


require_once "csrf_token.php";
require_once "users.php";

$errors = []; 


if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
    $errors[] = "CSRF token tidak valid.";
}

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Cek input user

if ($username === '' || $password === '') {
    $errors[] = "Username dan password wajib diisi.";
}

$found = false;
foreach ($users as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
        $found = true;
        session_regenerate_id(true);
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $user['role'];
        $_SESSION['login_time'] = time();

        switch ($user['role']) {
            case 'admin':
                header("Location: ../admin/index.php"); exit;
            case 'user':
                header("Location: ../user/index.php"); exit;
            case 'master':
                header("Location: ../master/index.php"); exit;
        }
    }
}

if (!$found) {
    $errors[] = "Username atau password salah.";
}




unset($_SESSION['csrf_token']);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../index.php");
    exit;
}
