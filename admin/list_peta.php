<?php

    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "list";
    $judul_halaman = "List Peta - Admin";
    $jenis_peta = htmlspecialchars($_GET['j']);

    require_once "../helper/header.php";
    require_once "../helper/footer.php";


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
            <li class="breadcrumb-item active" aria-current="page"><?= kamusPeta($jenis_peta)?></li>
        </ol>
    </nav>

    <div class="accordion" id="accordionTambahData">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Tambah Data
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionTambahData">
            <div class="accordion-body">
                <form method="post" class="d-grid gap-3">
                    
                    <input class="form-control" type="text" value="<?=kamusPeta($jenis_peta)?>" disabled>
                    <input class="form-control" type="text" name="namapeta" placeholder="Masukkan Nama Peta">
                    <input type="hidden" name="wilayah" value="<?=$jenis_peta?>">

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
                        <input type="file" class="form-control" id="png">
                    </div>
                    <div class="mb-3">
                        <label for="kml" class="form-label">Gambar KML</label>
                        <input type="file" class="form-control" id="kml">
                    </div>
                    <div class="mb-3">
                        <label for="pdf" class="form-label">Gambar PDF</label>
                        <input type="file" class="form-control" id="pdf">
                    </div>
                    <div class="mb-3">
                        <label for="excel" class="form-label">File Excel</label>
                        <input type="file" class="form-control" id="excel">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Tambah Peta">             
                </form>
            </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="card mb-4">
        <div class="card-header fw-bold">Peta..</div>
        <div class="card-body">
            <div class="table-responsive p-2">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Peta</th>
                            <th>PG</th>
                            <th>Tanggal</th>
                            <th>PNG</th>
                            <th>KML</th>
                            <th>PDF</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Peta Wilayah</td>
                            <td>PG1</td>
                            <td>11/07/2025</td>
                            <td><a href="#">bla.png</a></td>
                            <td><a href="#">bla.kml</a></td>
                            <td><a href="#">bla.pdf</a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-primary" href="edit_peta.php?j=<?=$jenis_peta?>">Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Peta Wilayah</td>
                            <td>PG2</td>
                            <td>11/07/2025</td>
                            <td><a href="#">bla.png</a></td>
                            <td><a href="#">bla.kml</a></td>
                            <td><a href="#">bla.pdf</a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-primary" href="edit_peta.php?j=<?=$jenis_peta?>">Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Jenis Peta</th>
                            <th>PG</th>
                            <th>Tanggal</th>
                            <th>PNG</th>
                            <th>KML</th>
                            <th>PDF</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>

    <hr>
    <div class="mb-3">role: <?=$role?></div>


</div>


<?php
    footerWeb($halaman);
?>









