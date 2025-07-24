<?php
    $pengguna = "User";
    $role = "user";
    $halaman = "index";
    $judul_halaman = "Selamat Datang User";

    require_once "../helper/header.php";
    require_once "../helper/footer.php";
    require_once "../helper/jenis_peta.php";


?>

<div class="container">

    <?php jenisPeta(); ?>
    
    <hr>
    <div class="mb-3">role: <?=$role?></div>



    
    
</div>





<?php
    footerWeb($halaman);
?>