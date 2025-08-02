<?php

    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "edit";
    $judul_halaman = "Edit Marginal - Admin";

    require_once "../helper/footer.php";
    require_once "../helper/header.php";

 

?>

<div class="container">

        <h1><?=$judul_halaman?></h1>

        <hr>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="marginal.php">Data Marginal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Marginal</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header fw-bold">Edit Data Peta</div>
            <div class="card-body">
                <form method="post" class="d-grid gap-3">

                    <input class="form-control" type="text" name="namapeta" placeholder="Nama Data Marginal">

                    <input type="date" class="form-control" name="tanggal">
                    
                    <input type="submit" class="btn btn-primary" value="Edit Data">             
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header fw-bold">Edit Excel - Hapus Dulu Sebelum Diganti</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Nama Excel</div>
                    <a href="#" class="text-danger">Hapus</a>
                </div>
                <hr>
                <form method="post">
                    <div class="mb-3">
                        <label for="png" class="form-label">Gambar PNG</label>
                        <input type="file" class="form-control" id="png">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ganti Excel">             
                </form>
            </div>
        </div>

    
        <hr>
   
        <div class="mb-3">role: <?=$role?></div>


</div>

<?php
    footerWeb($halaman);
?>