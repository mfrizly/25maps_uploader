<?php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

require_once "../helper/redirect_helper.php";


function handle_login(mysqli $conn, string $username, string $password): array {
    $errors = [];

    if ($username === '' || $password === '') {
        $errors[] = "Username dan password wajib diisi.";
        return $errors;
    }

    $stmt = $conn->prepare("SELECT username, password, role FROM users WHERE username = ?");
    if (!$stmt) {
        $errors[] = "Gagal mempersiapkan statement.";
        return $errors;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['login_time'] = time();

        $stmt->close();
        $conn->close();

        switch ($user['role']) {
            case 'admin':
                header("Location: ../admin/index.php");
                exit;
            case 'user':
                header("Location: ../user/index.php");
                exit;
            default:
                $errors[] = "Role tidak dikenali.";
        }
    } else {
        $errors[] = "Username atau password salah.";
    }

    $stmt->close();
    $conn->close();

    return $errors;
}