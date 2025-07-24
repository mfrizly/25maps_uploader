<?php

    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "index";
    $judul_halaman = "Selamat Datang Admin";

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