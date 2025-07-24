<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

if (!isset($_SESSION['user']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit;
}

if (time() - $_SESSION['login_time'] > 18000) { // 5 jam
    session_unset();
    session_destroy();
    header("Location: ../index.php?timeout=1");
    exit;
}

function allow_role(array $roles) {
    if (!in_array($_SESSION['role'], $roles)) {
        header("Location: ../index.php");
        exit;
    }
}
