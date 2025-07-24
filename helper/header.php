<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

    function kamusPeta($singkatan){
        switch ($singkatan) {
            case 'PGAW':
                return 'Peta Global Area Wilayah';
                break;
            case 'PGAJT':
                return 'Peta Global Area Jenis Tanaman';
                break;
            case 'PGAKAPG':
                return 'Peta Global Area Komoditi All PG';
                break;
            case 'PGP':
                return 'Peta Global Polos';
                break;
            case 'PGSKNU':
                return 'Peta Global Selain Komoditi Non Utama';
                break;
            case 'PGST':
                return 'Peta Global Status Tanaman';
                break;
            case 'BA':
                return 'Bolder Area';
                break;
            default:
                return "tidak ada di kamus";
                break;
        }
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$judul_halaman?></title>

        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">  
        <link rel="stylesheet" href="../lib/datatables/datatables.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_outward" />

        <style>
            .card-hover:hover {
                background-color: #FF5733;
                color: whitesmoke;
            }
        </style>

    </head>
    <body>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-4">
            <img src="https://i.pinimg.com/736x/02/91/2c/02912cce29eda4efc9397ca56195559c.jpg" width="50" alt="">
            <div class="fw-bold p-3">Marginal Land Planning & Land Mapping</div>
            
            
                
                <?php
                    if ($role == "master" && $halaman != "pengaturan_pengguna") {
                ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?=$pengguna?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="pengaturan_pengguna.php">Pengaturan </a></li>
                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item text-danger" href="logout.php">Keluar</a></li>
                    </ul>
                </div>
        
                <?php } else { ?>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?=$pengguna?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-danger" href="logout.php">Keluar</a></li>
                    </ul>

                
                <?php } ?>
                
                
            </div>

        </div>
    </div>

