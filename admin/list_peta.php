<?php

    $pengguna = "Admin";
    $role = "admin";
    $halaman = "list";
    $judul_halaman = "List Peta - Admin";

    require_once "../helper/footer.php";
    require_once "../helper/header.php";

?>

<div class="container">
    
    <hr>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Peta Global Area Wilayah</li>
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
                    <select name="wilayah" class="form-select">
                        <option selected>Pilih Jenis Peta..</option>
                        <option value="PGAW">Peta Global Area Wilayah</option>
                        <option value="PGAJT">Peta Global Area Jenis Tanam</option>
                        <option value="PGAAKAPG">Peta Global Area Komoditi All PG</option>
                        <option value="PGP">Peta Global Polos</option>
                        <option value="PGSKNU">Peta Global Selain Komoditi Non Utama</option>
                        <option value="PGST">Peta Global Status Tanaman</option>
                        <option value="BA">Bolder Area</option>
                    </select>
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
                <table id="tablePeta" class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Peta</th>
                            <th>PG</th>
                            <th>Tanggal</th>
                            <th>PNG</th>
                            <th>KML</th>
                            <th>PDF</th>
                            <th>Excel</th>
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
                            <td><a href="#">bla.excel</a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-primary" href="#">Edit</a></li>
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
                            <td><a href="#">bla.excel</a></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-primary" href="#">Edit</a></li>
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
                            <th>Excel</th>
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









