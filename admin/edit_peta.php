<?php

    session_start();
    $_SESSION['_data_peta'] = true;

    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);
    


    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "edit";
    $judul_halaman = "Edit Peta - Admin";
    $id_peta = htmlspecialchars($_GET['id']);


    require_once "../helper/footer.php";
    require_once "../helper/header.php";

    require_once "../database/database.php";
    require_once "../database/read.php";
    
    require_once "../helper/csrf_token.php";
    require_once "../helper/redirect_helper.php";
    
    $csrf_token = generate_csrf_token();
    $jenis_peta = htmlspecialchars($_GET['j']);

    if (!isset($_GET['id'])) {
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
                <li class="breadcrumb-item active" aria-current="page"><a href="list_peta.php?j=<?=$jenis_peta?>"><?=kamusPeta($jenis_peta)?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Peta</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header fw-bold">Edit Data Peta</div>
            <div class="card-body">
                <?php
                        $conn = get_connection();
                        $query = "SELECT id, pg, tanggal_upload, jenis_peta, nama_peta, png, kml, pdf FROM data_peta WHERE id = ?";
                        $data = read($conn, $query, "i", [$id_peta]);

                    
                        foreach ($data as $d) {
                                
                            
                ?>
                <form method="post" class="d-grid gap-3" action="../admin_model/edit_peta.php">
                    <select name="wilayah" class="form-select">
                        <option value="PGAW" <?php if ($d['jenis_peta'] == "PGAW") echo "selected"?> >Peta Global Area Wilayah</option>
                        <option value="PGAJT" <?php if ($d['jenis_peta'] == "PGAJT") echo "selected"?> >Peta Global Area Jenis Tanam</option>
                        <option value="PGAAKAPG" <?php if ($d['jenis_peta'] == "PGAAKAPG") echo "selected"?> >Peta Global Area Komoditi All PG</option>
                        <option value="PGP" <?php if ($d['jenis_peta'] == "PGP") echo "selected"?> >Peta Global Polos</option>
                        <option value="PGSKNU" <?php if ($d['jenis_peta'] == "PGSKNU") echo "selected"?> >Peta Global Selain Komoditi Non Utama</option>
                        <option value="PGST" <?php if ($d['jenis_peta'] == "PGST") echo "selected"?> >Peta Global Status Tanaman</option>
                        <option value="BA" <?php if ($d['jenis_peta'] == "BA") echo "selected"?> >Bolder Area</option>
                    </select>

                    <input class="form-control" type="text" name="namapeta" placeholder="Masukkan Nama Peta" value="<?=$d['nama_peta']?>" required>

                    <select name="pg" class="form-select">
                        <option value="PG1" <?php if ($d['pg'] == "PG1") echo "selected"?>>PG1</option>
                        <option value="PG2" <?php if ($d['pg'] == "PG2") echo "selected"?>>PG2</option>
                        <option value="PG3" <?php if ($d['pg'] == "PG3") echo "selected"?>>PG3</option>
                        <option value="PG4" <?php if ($d['pg'] == "PG4") echo "selected"?>>PG4</option>
                        <option value="ALLPG" <?php if ($d['pg'] == "ALLPG") echo "selected"?>>ALLPG</option>
                    </select>

                    <input type="date" class="form-control" name="tanggal" value="<?=$d['tanggal_upload']?>">
                    <input type="hidden" name="id" value="<?=$d['id']?>">
                    <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                    
                    <input type="submit" class="btn btn-primary" value="Edit Peta">             
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header fw-bold">Edit PNG</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div><?=$d['png']?></div>
                </div>
                <hr>
                <form method="post" action="../admin_model/edit_peta_png.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="png" class="form-label">Gambar PNG</label>
                        <input type="file" class="form-control" id="png" name="png" accept=".png" required>
                        <input type="hidden" name="id" value="<?=$d['id']?>">
                        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                        <input type="hidden" name="wilayah" value="<?=$d['jenis_peta']?>">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ganti PNG">             
                </form>
            </div>
        </div>

         <div class="card mt-3">
            <div class="card-header fw-bold">Edit KML</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div><?=$d['kml']?></div>
                </div>
                <hr>
                <form method="post" action="../admin_model/edit_peta_kml.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="kml" class="form-label">Gambar KML</label>
                        <input type="file" class="form-control" id="kml" name="kml" accept=".kml" required>
                        <input type="hidden" name="id" value="<?=$d['id']?>">
                        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                        <input type="hidden" name="wilayah" value="<?=$d['jenis_peta']?>">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ganti kml">             
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header fw-bold">Edit PDF</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div><?=$d['pdf']?></div>
                </div>
                <hr>
                <form method="post" action="../admin_model/edit_peta_pdf.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pdf" class="form-label">Gambar PDF</label>
                        <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf" required>
                        <input type="hidden" name="id" value="<?=$d['id']?>">
                        <input type="hidden" name="wilayah" value="<?=$d['jenis_peta']?>">
                        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ganti PDF" >             
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