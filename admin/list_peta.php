<?php

    session_start();
    $_SESSION['_data_peta'] = true;

    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "list";
    $judul_halaman = "List Peta - $pengguna";
    $jenis_peta = htmlspecialchars($_GET['j']);

    require_once "../helper/header.php";
    require_once "../helper/footer.php";

    require_once "../database/database.php";
    require_once "../database/read.php";
    
    require_once "../helper/csrf_token.php";
    require_once "../helper/redirect_helper.php";
    
    $csrf_token = generate_csrf_token();


    $data = get_redirect_data();
    $pesans = $data["pesans"] ?? [];

    if (!isset($_GET['j'])) {
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
            <li class="breadcrumb-item"><a href="peta.php">Data Peta</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= kamusPeta($jenis_peta)?></li>
        </ol>
    </nav>

    <?php if (!empty($pesans)): ?>
        <div class="alert alert-warning">
            <ul>
                <?php foreach ($pesans as $p): ?>
                    <li><?= htmlspecialchars($p) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="accordion" id="accordionTambahData">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Tambah Data
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionTambahData">
            <div class="accordion-body">
                <form method="post" class="d-grid gap-3" action="../admin_model/tambah_peta.php" enctype="multipart/form-data">
                    
                    <input class="form-control" type="text" value="<?=kamusPeta($jenis_peta)?>" disabled>
                    <input class="form-control" type="text" name="namapeta" placeholder="Masukkan Nama Peta" required>
                    <input type="hidden" name="wilayah" value="<?=$jenis_peta?>">
                    <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">

                    <select name="pg" class="form-select">
                            <option selected>PG..</option>
                            <option value="PG1">PG1</option>
                            <option value="PG2">PG2</option>
                            <option value="PG3">PG3</option>
                            <option value="PG4">PG4</option>
                            <option value="ALLPG">ALLPG</option>
                        </select>
                    <input type="date" class="form-control" name="tanggal">     
                    <div class="mb-3">
                        <label for="png" class="form-label">Gambar PNG</label>
                        <input type="file" class="form-control" id="png" name="png" accept=".png" required>
                    </div>
                    <div class="mb-3">
                        <label for="kml" class="form-label">Gambar KML</label>
                        <input type="file" class="form-control" id="kml" name="kml" accept=".kml" required>
                    </div>
                    <div class="mb-3">
                        <label for="pdf" class="form-label">Gambar PDF</label>
                        <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf" required>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Tambah Peta">             
                </form>
            </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="card mb-4">
        <div class="card-header fw-bold">List Peta</div>
        <div class="card-body">
            <div class="table-responsive p-2">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Peta</th>
                            <th>Nama Peta</th>
                            <th>PG</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $conn = get_connection();
                            $query = "SELECT id, tanggal_upload, pg, jenis_peta, nama_peta FROM data_peta WHERE jenis_peta = ?";
                            $data = read($conn, $query, "s", [$jenis_peta]);

                            $no = 1;
                        
                            foreach ($data as $d) {
                                
                            
                        ?>

                        <tr>
                            <td><?=$no++?></td>
                            <td><?=kamusPeta($d['jenis_peta'])?></td>
                            <td><a href="data_peta.php?id=<?=$d['id']?>&j=<?=$jenis_peta?>"> <?=$d['nama_peta']?> </a></td>
                            <td><?=$d['pg']?></td>
                            <td><?=$d['tanggal_upload']?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-primary" href="edit_peta.php?id=<?=$d['id']?>&j=<?=$jenis_peta?>">Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="../admin_model/hapus_peta.php?id=<?=$d['id']?>&j=<?=$jenis_peta?>">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <?php } ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Jenis Peta</th>
                            <th>Nama Peta</th>
                            <th>PG</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>

    <hr>
    <div class="mb-3 fs-6">pengguna: <?=$pengguna?> | role: <?=$role?></div>


</div>


<?php
    footerWeb($halaman);
?>









