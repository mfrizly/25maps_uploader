<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

// Simulasi database user
$users = [
    ['username' => 'admin', 'password' => 'admin', 'role' => 'admin'],
    ['username' => 'user', 'password' => 'user', 'role' => 'user']
];
