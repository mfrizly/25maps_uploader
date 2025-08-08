<?php

    session_start();
    $_SESSION['_data_peta'] = true;

    
    require_once "../helper/session_protect.php";
    allow_role(['user']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "data_peta";
    $judul_halaman = "Data Peta - User";
    $jenis_peta = htmlspecialchars($_GET['j']);
    $id_peta = htmlspecialchars($_GET['id']);

    require_once "../helper/header.php";
    require_once "../helper/footer.php";

    require_once "../database/database.php";
    require_once "../database/read.php";
    


    if (!isset($_GET['id']) && !isset($_GET['j'])) {
        header("Location: index.php");
        exit;
    }

?>

<div class="container">

    <h1><?=$judul_halaman?></h1>
    <hr>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php">Data Peta</a></li>
            <li class="breadcrumb-item"><a href="list_peta.php?j=<?=$jenis_peta?>"> <?= kamusPeta($jenis_peta)?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Peta</li>
        </ol>
    </nav>

     <?php
        $conn = get_connection();
        $query = "SELECT id, png, kml, pdf FROM data_peta WHERE id = ?";
        $data = read($conn, $query, "i", [$id_peta]);

        $no = 1;

        foreach ($data as $d) {
            
        
    ?>

     <div class="col">
        <div class="card">
            <div class="card-body">
                <img class="card-img-bottom" src="../storage/png/<?=$d['png']?>" loading="lazy" style="pointer-events: none;">
            </div>
        </div>
    </div>

    <hr>

    <div class="row g-3 my-3">
        <div class="col-md-4">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title">PNG</h5>
                <a href="../storage/png/<?=$d['png']?>" download>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0000F5"><path d="M260-500v-40h40v40h-40Zm400 140h40q25 0 42.5-17.5T760-420v-60h-60v60h-40v-120h100q0-25-17.5-42.5T700-600h-40q-25 0-42.5 17.5T600-540v120q0 25 17.5 42.5T660-360Zm-460 0h60v-80h60q17 0 28.5-11.5T360-480v-80q0-17-11.5-28.5T320-600H200v240Zm200 0h60v-96l40 96h60v-240h-60v94l-40-94h-60v240ZM160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm0 0v-480 480Zm0 0v-480 480Z"/></svg>
                </a>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title">KML</h5>
                <a href="../storage/kml/<?=$d['kml']?>" download>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB4C"><path d="m600-120-240-84-186 72q-20 8-37-4.5T120-170v-560q0-13 7.5-23t20.5-15l212-72 240 84 186-72q20-8 37 4.5t17 33.5v560q0 13-7.5 23T812-192l-212 72Zm-40-98v-468l-160-56v468l160 56Zm80 0 120-40v-474l-120 46v468Zm-440-10 120-46v-468l-120 40v474Zm440-458v468-468Zm-320-56v468-468Z"/></svg>
                </a>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title">PDF</h5>
                <a href="../storage/pdf/<?=$d['pdf']?>" dowload>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ff0000"><path d="M360-460h40v-80h40q17 0 28.5-11.5T480-580v-40q0-17-11.5-28.5T440-660h-80v200Zm40-120v-40h40v40h-40Zm120 120h80q17 0 28.5-11.5T640-500v-120q0-17-11.5-28.5T600-660h-80v200Zm40-40v-120h40v120h-40Zm120 40h40v-80h40v-40h-40v-40h40v-40h-80v200ZM320-240q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320Zm0-80h480v-480H320v480ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z"/></svg>
                </a>
              </div>
            </div>
        </div>
    </div>


    <?php } ?>
    
    

    <hr>
    <div class="mb-3">role: <?=$role?></div>


</div>


<?php
    footerWeb($halaman);
?>









