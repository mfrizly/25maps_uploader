<?php

function upload_file(array $file, array $allowedTypes, string $destinationDir): array
{
    // Cek apakah upload error atau tidak ada file
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return [
            'success' => false,
            'error' => 'Terjadi kesalahan saat upload file.'
        ];
    }

    // Cek jika user mengirim lebih dari satu file
    if (is_array($file['name'])) {
        return [
            'success' => false,
            'error' => 'Hanya boleh mengunggah satu file.'
        ];
    }

    // Ekstensi dan nama aman
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension    = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $tmpPath      = $file['tmp_name'];

    if (!in_array($extension, $allowedTypes)) {
        return [
            'success' => false,
            'error' => 'Tipe file tidak diizinkan.'
        ];
    }

    // Buat folder jika belum ada
    if (!is_dir($destinationDir)) {
        mkdir($destinationDir, 0775, true);
    }

    // Sanitasi nama dan buat nama unik
    $safeName   = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
    $datePrefix = date('Ymd_His');
    $newName    = "{$datePrefix}_{$safeName}.{$extension}";
    $fullPath   = rtrim($destinationDir, '/') . '/' . $newName;

    $success = move_uploaded_file($tmpPath, $fullPath);

    return [
        'success' => $success,
        'error' => $success ? null : 'Gagal memindahkan file.',
        'filename' => $success ? $newName : null
    ];
}

