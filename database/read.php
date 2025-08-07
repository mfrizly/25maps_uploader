<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}


function read(mysqli $conn, string $query, string $datatype = "", array $params = []): array {
    $data = [];

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        return []; // atau bisa juga lempar exception atau log error
    }

    if ($datatype && $params) {
        $stmt->bind_param($datatype, ...$params);
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    $stmt->close();
    return $data;
}