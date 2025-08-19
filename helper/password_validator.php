<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

function validatePassword($password) {
    // At least one uppercase
    $uppercase = preg_match('@[A-Z]@', $password);
    // At least one lowercase
    $lowercase = preg_match('@[a-z]@', $password);
    // At least one number
    $number    = preg_match('@[0-9]@', $password);
    // At least one special character
    $specialChars = preg_match('@[^\w]@', $password);
    // At least 8 characters long
    $length = strlen($password) >= 8;

    if ($uppercase && $lowercase && $number && $specialChars && $length) {
        return true;
    } else {
        return false;
    }
}