<?php
session_start();

$errors = []; 





// Cek input user
if ($_POST['username'] === "user" && $_POST['password'] === "user") {
    session_regenerate_id(true); // Lindungi dari session fixation
    $_SESSION['user'] = $user['username'];
    $_SESSION['role'] = "user";
    $_SESSION['login_time'] = time(); // Waktu login

    header("Location: user/index.php");
    exit;
} else {
    $errors[] = "Username atau Password Salah";
    
}

if ($_POST['username'] === "admin" && $_POST['password'] === "admin") {
    session_regenerate_id(true); // Lindungi dari session fixation
    $_SESSION['user'] = $user['username'];
    $_SESSION['role'] = "admin";
    $_SESSION['login_time'] = time(); // Waktu login

    header("Location: admin/index.php");
    exit;
} else {
    $errors[] = "Username atau Password Salah";
    
}

if ($_POST['username'] === "master" && $_POST['password'] === "master") {
    session_regenerate_id(true); // Lindungi dari session fixation
    $_SESSION['user'] = $user['username'];
    $_SESSION['role'] = "admin";
    $_SESSION['login_time'] = time(); // Waktu login

    header("Location: master/index.php");
    exit;
} else {
    $errors[] = "Username atau Password Salah";
    
}

// Validasi CSRF
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    $errors[] = "Token CSRF tidak valid.";
}

unset($_SESSION['csrf_token']);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit;
}
