<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}


function cud(
    mysqli $conn,
    string $query,
    string $datatype = "",
    array $params = []
): array {

    mysqli_report(MYSQLI_REPORT_OFF);

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        return [
            'success' => false,
            'error' => "Prepare failed: " . $conn->error
        ];
    }

    if ($datatype && $params) {
        $stmt->bind_param($datatype, ...$params);
    }

    $success = $stmt->execute();
    $error = $stmt->error;
    $stmt->close();

    return [
        'success' => $success,
        'error' => $success ? null : $error
    ];
}


// untuk manggil

// $conn = get_connection();
// $success = cud($conn, "UPDATE maps SET title = ? WHERE id = ?", "si", [$title, $id]);

// if ($success) {
//     if ($jenis_peta && $id) {
//         header("Location: $halaman_redirect?j=$jenis_peta&id=$id&pesan=$jenis_eksekusi");
//         exit;
//     } else {
//         redirect_with($halaman_redirect, ["success" => "$jenis_eksekusi"]);
//     }
// } else {
//     redirect_with($halaman_redirect, ["errors" => ["Gagal menjalankan perintah."]]);
// }
// $conn->close();
