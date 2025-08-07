<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

require_once "redirect_helper.php";

if (!isset($_SESSION['user']) || !isset($_SESSION['role'])) {
    redirect_with("../index.php");
}

if (time() - $_SESSION['login_time'] > 7200) { // 2 jam
    session_unset();
    session_destroy();
    redirect_with("../index.php");
}

function allow_role(array $roles) {
    if (!in_array($_SESSION['role'], $roles)) {
        redirect_with("../index.php");
    }
}
