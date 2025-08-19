<?php

require_once "../helper/redirect_helper.php";

$type = htmlspecialchars(strtolower(trim($_GET['type'])));
$file_name = htmlspecialchars((trim($_GET['file'])));
$jenis_peta = htmlspecialchars((trim($_GET['j'])));
$id = htmlspecialchars((trim($_GET['id'])));

if (empty($type) && empty($file_name)) {
    $pesans[] = "Tidak Bisa download data kosong";
    redirect_with("../user/list_peta.php?j=$jenis_peta", ["pesans" => $pesans]);
} else {

    if ($type == "excel") {

        $file = "../storage/excel/$file_name";

        if (ob_get_level()) {
            ob_end_clean();
        }

        if (file_exists($file)) {
        // Header untuk paksa browser download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
        redirect_with("../user/marginal.php");
        } else {
            $pesans[] = "File tidak ditemukan";
            redirect_with("../user/marginal.php", ["pesans" => $pesans]);
        }

    } elseif ($type == "kml") {
        $file = "../storage/kml/" . $file_name;
    } elseif ($type == "png") {
        $file = "../storage/png/" . $file_name;
    } elseif ($type == "pdf") {
        $file = "../storage/pdf/" . $file_name;
    } else {
        $pesans[] = "format tidak ditemukan";
        redirect_with("../user/list_peta.php?j=$jenis_peta", ["pesans" => $pesans]);
    }

    if (ob_get_level()) {
            ob_end_clean();
    }

    if (file_exists($file)) {
        // Header untuk paksa browser download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
        redirect_with("../user/data_peta.php?id=$id&j=$jenis_peta");
    } else {
        $pesans[] = "File tidak ditemukan";
        redirect_with("../user/list_peta.php?j=$jenis_peta", ["pesans" => $pesans]);
    }
}

?>
