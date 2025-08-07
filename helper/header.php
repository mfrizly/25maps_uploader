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

        <link rel="icon" type="image/x-icon" href="../lib/img/ggf.png">


        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">  
        <link rel="stylesheet" href="../lib/datatables/datatables.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_outward" />
        <style>
            .card-hover:hover {
                background-color: #13ba21ff;
                color: whitesmoke;
            }

            body {
                background-color: #e7e7e7ff;
            }

        </style>

    </head>
    <body>

    <div class="container shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
            ☰
            </button>

            <div class="fw-bold p-3">Marginal Land Planning & Land Mapping</div>


            <img src="../lib/img/ggf.png" width="80" alt="" style="pointer-events: none;">
        

        </div>
    </div>

    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="staticBackdropLabel">Menu - <?=$pengguna?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="shadow p-3 rounded fw-bold">
            <a href="index.php" class="link-offset-2 link-underline link-underline-opacity-0"> 
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#5985E1"><path d="M264-216h96v-240h240v240h96v-348L480-726 264-564v348Zm-72 72v-456l288-216 288 216v456H528v-240h-96v240H192Zm288-327Z"/></svg>
            | Dashboard
            </a>
        </div>
        <div class="shadow p-3 rounded fw-bold">
            <a href="marginal.php" class="link-offset-2 link-underline link-underline-opacity-0"> 
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#5985E1"><path d="M479.5-144q-140.5 0-238-41.85T144-288v-384q0-60 98-102t237.5-42q139.5 0 238 42T816-672v384q0 60.3-98 102.15Q620-144 479.5-144Zm.47-456Q566-600 646-621.5t98-50.5q-18-28-98.5-50t-165.53-22Q394-744 313.5-722T216-672q17 29 96.5 50.5T479.97-600Zm.03 192q42 0 80-4.5t71.5-12.5q33.5-8 62-20.5T744-474v-109q-24.25 13.22-53.62 23.61Q661-549 627.17-542.15q-33.83 6.85-71 10.5Q519-528 479.5-528t-77.11-3.65q-37.62-3.65-71-10.5Q298-549 268.5-559.5 239-570 216-583v109q22.41 15.94 50.21 28.47Q294-433 327.5-425q33.5 8 72 12.5T480-408Zm.32 192q43.32 0 88.05-6.4 44.73-6.39 82.4-16.9 37.67-10.5 63.09-23.75Q739.29-276.3 744-290v-101q-24.25 13.22-53.62 23.61Q661-357 627.17-350.15q-33.83 6.85-71 10.5Q519-336 479.5-336t-77.11-3.65q-37.62-3.65-71-10.5Q298-357 268.5-367.5 239-378 216-391v103q5 13 30.5 26t63 23q37.5 10 82.5 16.5t88.32 6.5Z"/></svg>
            | Data Marginal
            </a>
        </div>

        <?php
            if ($role == "admin") {
        ?>

            <div class="shadow p-3 rounded fw-bold">
            <a href="pengaturan_pengguna.php" class="link-offset-2 link-underline link-underline-opacity-0"> 
            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#5985E1"><path d="M576-696v-72h288v72H576Zm0 156v-72h288v72H576Zm0 156v-72h288v72H576Zm-240-48q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM96-192v-63q0-28 14.5-51t38.5-35q43-21 90-32t97-11q50 0 97 11t90 32q24 12 38.5 35t14.5 51v63H96Zm73-72h334q-30-23-72-35.5T336-312q-53 0-95 12.5T169-264Zm167-240q20.4 0 34.2-13.8Q384-531.6 384-552q0-20.4-13.8-34.2Q356.4-600 336-600q-20.4 0-34.2 13.8Q288-572.4 288-552q0 20.4 13.8 34.2Q315.6-504 336-504Zm0-48Zm0 288Z"/></svg>
            | Pengaturan Pengguna
            </a>
        </div>

        <?php
            }
        ?>
        
        
        <hr>
        <a href="logout.php" class="btn btn-danger fw-bold" style="width: 100%;">Keluar</a>
        

    </div>
    </div>

