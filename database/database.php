<?php


if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

require_once "../helper/redirect_helper.php";

define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "maps_uploader");

function get_connection() {
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 
    
    return $conn;
}





?>

