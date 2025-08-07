<?php

    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);
    
    if (!isset($_GET['j'])) {
        header("Location: index.php");
        exit;
    }

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "edit";
    $judul_halaman = "Edit Peta - Admin";
    $jenis_peta = htmlspecialchars($_GET['j']);

    require_once "../helper/footer.php";
    require_once "../helper/header.php";

    

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
                <form method="post" class="d-grid gap-3">
                    <select name="wilayah" class="form-select">
                        <option value="PGAW" <?php if ($jenis_peta == "PGAW") echo "selected"?>>Peta Global Area Wilayah</option>
                        <option value="PGAJT" <?php if ($jenis_peta == "PGAJT") echo "selected"?>>Peta Global Area Jenis Tanam</option>
                        <option value="PGAAKAPG" <?php if ($jenis_peta == "PGAAKAPG") echo "selected"?>>Peta Global Area Komoditi All PG</option>
                        <option value="PGP" <?php if ($jenis_peta == "PGP") echo "selected"?> >Peta Global Polos</option>
                        <option value="PGSKNU" <?php if ($jenis_peta == "PGSKNU") echo "selected"?>>Peta Global Selain Komoditi Non Utama</option>
                        <option value="PGST" <?php if ($jenis_peta == "PGST") echo "selected"?>>Peta Global Status Tanaman</option>
                        <option value="BA" <?php if ($jenis_peta == "BA") echo "selected"?>>Bolder Area</option>
                    </select>

                    <input class="form-control" type="text" name="namapeta" placeholder="Masukkan Nama Peta">

                    <select name="pg" class="form-select">
                        <option selected>PG..</option>
                        <option value="PG1">PG1</option>
                        <option value="PG2">PG2</option>
                        <option value="PG3">PG3</option>
                        <option value="PG4">PG4</option>
                        <option value="ALLPG">ALLPG</option>
                    </select>
                    <input type="date" class="form-control" name="tanggal">
                    
                    <input type="submit" class="btn btn-primary" value="Edit Peta">             
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header fw-bold">Edit PNG - Hapus Dulu Sebelum Diganti</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Nama Gambar</div>
                    <a href="#" class="text-danger">Hapus</a>
                </div>
                <hr>
                <form method="post">
                    <div class="mb-3">
                        <label for="png" class="form-label">Gambar PNG</label>
                        <input type="file" class="form-control" id="png">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ganti PNG">             
                </form>
            </div>
        </div>

         <div class="card mt-3">
            <div class="card-header fw-bold">Edit KML - Hapus Dulu Sebelum Diganti</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Nama KML</div>
                    <a href="#" class="text-danger">Hapus</a>
                </div>
                <hr>
                <form method="post">
                    <div class="mb-3">
                        <label for="kml" class="form-label">Gambar KML</label>
                        <input type="file" class="form-control" id="kml">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ganti kml">             
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header fw-bold">Edit PDF - Hapus Dulu Sebelum Diganti</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Nama PDF</div>
                    <a href="#" class="text-danger">Hapus</a>
                </div>
                <hr>
                <form method="post">
                    <div class="mb-3">
                        <label for="pdf" class="form-label">Gambar PDF</label>
                        <input type="file" class="form-control" id="pdf">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Ganti PDF">             
                </form>
            </div>
        </div>
    
        <hr>
   
        <div class="mb-3">role: <?=$role?></div>


</div>

<?php
    footerWeb($halaman);
?>