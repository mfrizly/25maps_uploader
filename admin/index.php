<?php

    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "index";
    $judul_halaman = "Selamat Datang - $pengguna";

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
?>
 
<div class="container">       

    <h1>
        <?=$judul_halaman?>
    </h1>
    <hr>

    

    <?php 
    dashboardPeta($pgaw, $pgajt, $pgakapg, $pgp, $pgsknu, $pgst);
    
    ?>
    
    
    <hr>
    <div class="mb-3 fs-6">pennguna: <?=$pengguna?> | role: <?=$role?></div>



    
    
</div>




<?php
    footerWeb($halaman);
?>