<?php
session_start();


if (!isset($_SESSION['_auth_access'])) {
    http_response_code(403);
    exit('Akses langsung dilarang.');
}

unset($_SESSION['_auth_access']); 

require_once "csrf_token.php";
require_once "users.php";
require_once "redirect_helper.php";

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
    redirect_with("../index.php", ['errors' => $errors]);
}
