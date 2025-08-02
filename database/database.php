<?php


if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

require_once "../helper/redirect_helper.php";

define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "password");
define("DB_NAME", "maps_uploader");

function get_connection() {
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }    
}


function read($query, $datatype = "", $params = []) {
    $conn = get_connection();
    $stmt = $conn->prepare($query);
    if ($datatype && $params) {
        $stmt->bind_param($datatype, ...$params);
    } 

    $stmt->execute();

    $result = $stmt->get_result();
    $data= $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();

    return $data;
}



function cud($query, $datatype = "", $params = [], $halaman_redirect, $jenis_eksekusi, $jenis_peta, $id){
    $conn = get_connection();
    $stmt = $conn->prepare($query);
    
    $stmt->bind_param($datatype, ...$params); 
    $stmt->execute();

    $stmt->close();
    $conn->close();

    if ($jenis_peta && $id) {

        header("Location: $halaman_redirect?j=$jenis_peta&id=$id&pesan=$jenis_eksekusi");

    } else {

        return redirect_with($halaman_redirect, [
            "success" => "$jenis_eksekusi",
        ]);

    }
}



?>

