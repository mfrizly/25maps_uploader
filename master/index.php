<?php

    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['master']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "edit";
    $judul_halaman = "Edit Peta - Master";

    require_once "../helper/footer.php";
    require_once "../helper/header.php";
    require_once "../helper/jenis_peta.php";


?>

<div class="container">

    <hr>

    <?php jenisPeta(); ?>

    
    
    <hr>
    <div class="mb-3">role: <?=$role?></div>



    
    
</div>




<?php
    footerWeb($halaman);
?>