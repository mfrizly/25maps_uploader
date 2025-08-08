<?php

    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['user']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "peta";
    $judul_halaman = "Data Peta - User";

    require_once "../helper/footer.php";
    require_once "../helper/header.php";
    require_once "../helper/jenis_peta.php";

    require_once "../database/database.php";
    require_once "../database/read.php";

    

    $pgaw = countDataPeta("PGAW");
    $pgajt = countDataPeta("PGAJT");
    $pgakapg = countDataPeta("PGAKAPG");
    $pgp = countDataPeta("PGP");
    $pgsknu = countDataPeta("PGSKNU");
    $pgst = countDataPeta("PGST");
    $ba = countDataPeta("BA");
?>
 
<div class="container">       

    <h1>
        <?=$judul_halaman?>
    </h1>
    <hr>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Data Peta</li>
        </ol>
    </nav>
    

    <?php 
    jenisPeta($pgaw, $pgajt, $pgakapg, $pgp, $pgsknu, $pgst, $ba);
    
    ?>
    
    
    <hr>
    <div class="mb-3 fs-6">role: <?=$role?></div>



    
    
</div>




<?php
    footerWeb($halaman);
?>