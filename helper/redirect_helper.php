<?php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Tidak diizinkan mengakses langsung.');
}

// Kirim data melalui session
function redirect_with($url, array $data = [])
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['_redirect_data'] = $data;
    header("Location: $url");
    exit;
}

// Ambil data setelah redirect
function get_redirect_data()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $data = $_SESSION['_redirect_data'] ?? [];
    unset($_SESSION['_redirect_data']);
    return $data;
}
