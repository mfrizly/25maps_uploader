<?php
    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['user']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "index";
    $judul_halaman = "Dashboard - User";

    require_once "../helper/header.php";
    require_once "../helper/footer.php";
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

    <h1><?=$judul_halaman?></h1>
    <hr>

    <?php
        dashboardPeta($pgaw, $pgajt, $pgakapg, $pgp, $pgsknu, $pgst, $ba); 
    ?>
    
    <hr>
    <div class="mb-3">role: <?=$role?></div>



    
    
</div>





<?php
    footerWeb($halaman);
?>