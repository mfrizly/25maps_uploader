<?php

    session_start();
    $_SESSION['_data_marginal'] = true;
    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);

    

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "edit";
    $judul_halaman = "Edit Marginal - Admin";

    require_once "../helper/footer.php";
    require_once "../helper/header.php";

    require_once "../database/database.php";
    require_once "../database/read.php";
    
    require_once "../helper/csrf_token.php";
    require_once "../helper/redirect_helper.php";

    if (!isset($_GET['id'])) {
        redirect_with("index.php");
    } else {
        $id = $_GET['id'];

        $conn = get_connection();
        $query = "SELECT * FROM data_marginal WHERE id= ?";
        $data = read($conn, $query, "i", [$id]);
    }

    $csrf_token = generate_csrf_token();


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

        
        <?php
            

            foreach ($data as $d) {
                
            
        ?>
        <div class="card">
            <div class="card-header fw-bold">Edit Data Peta</div>
            <div class="card-body">
                <form method="post" class="d-grid gap-3" action="../admin_model/edit_marginal.php">

                    <input class="form-control" type="text" name="namapeta" placeholder="Nama Data Marginal" value="<?=$d['nama_peta']?>">
                    <input type="date" class="form-control" name="tanggal" value="<?=$d['tanggal_upload']?>">
                    <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                    <input type="hidden" name="id" value="<?=$d['id']?>">

                    
                    <input type="submit" class="btn btn-primary" value="Edit Data">             
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header fw-bold">Edit Excel</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div><?=$d['excel_file']?></div>
                </div>
                <hr>
                <form method="post" action="../admin_model/edit_marginal_excel.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="excel" class="form-label">File Excel</label>
                        <input type="file" id="excel" class="form-control" accept=".xls,.xlsx" name="excel_file" required>
                        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                        <input type="hidden" name="id" value="<?=$d['id']?>">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ganti Excel">             
                </form>
            </div>
        </div>
        
        <?php } ?>
    
        <hr>
   
        <div class="mb-3">role: <?=$role?></div>


</div>

<?php
    footerWeb($halaman);
?>