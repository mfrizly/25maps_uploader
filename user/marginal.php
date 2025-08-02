<?php
    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['user']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "list";
    $judul_halaman = "Data Marginal - User";


    require_once "../helper/header.php";
    require_once "../helper/footer.php";



?>

<div class="container">

    <h1><?=$judul_halaman?></h1>

    <hr>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Data Marginal</li>
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
                    
                    <input class="form-control" type="text" name="namapeta" placeholder="Masukkan Nama Peta">
                    <input class="form-control" type="date" name="tanggal">
                    <input class="form-control" type="file" name="tanggal">

                    
                    <input type="submit" class="btn btn-primary" value="Tambah Data Marginal">             
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
                            <th>Tanggal Upload</th>
                            <th>Nama Data Marginal</th>
                            <th>Download Excel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>30/07/2024</td>
                            <td>Data 1</td>
                            <td><a href="#">bla.xls</a></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>11/07/2025</td>
                            <td>Data 1</td>
                            <td><a href="#">bla.xls</a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Upload</th>
                            <th>Nama Data Marginal</th>
                            <th>Download Excel</th>
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