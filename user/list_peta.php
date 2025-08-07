<?php
    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['user']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "list";
    $judul_halaman = "List Peta - User";
    $jenis_peta = htmlspecialchars($_GET['j']);


    require_once "../helper/header.php";
    require_once "../helper/footer.php";

    require_once "../database/database.php";
    require_once "../database/read.php";
    

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
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Peta Wilayah</td>
                            <td>PG2</td>
                            <td>11/07/2025</td>
                            <td><a href="#">bla.png</a></td>
                            <td><a href="#">bla.kml</a></td>
                            <td><a href="#">bla.pdf</a></td>
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