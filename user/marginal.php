<?php
    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['user']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "list";
    $judul_halaman = "Data Marginal - $pengguna";


    require_once "../helper/header.php";
    require_once "../helper/footer.php";
    require_once "../helper/redirect_helper.php";
    
    require_once "../database/database.php";
    require_once "../database/read.php";

    

    $data = get_redirect_data();
    $pesans = $data["pesans"] ?? [];


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


    
     <?php if (!empty($pesans)): ?>
        <div class="alert alert-warning">
            <ul>
                <?php foreach ($pesans as $p): ?>
                    <li><?= htmlspecialchars($p) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header fw-bold">Data Marginal</div>
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
                     <?php
                            $conn = get_connection();
                            $query = "SELECT * FROM data_marginal";
                            $datas = read($conn, $query);
                            $no = 1;

                          

                            foreach ($datas as $d) {
                                
                            
                        ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$d['tanggal_upload']?></td>
                            <td><?=$d['nama_peta']?></td>
                            <td><a href="../helper/u_download.php?file=<?=$d['excel_file']?>&type=excel">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#75FB4C"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v333q-19-11-39-20t-41-16v-137H520v137q-46 14-86 40t-74 63H200v160h82q11 22 22 42t24 38H200Zm0-320h240v-160H200v160Zm0-240h560v-80H200v80Zm280 200Zm0 0Zm0 0Zm0 0ZM640-40q-91 0-168-48T360-220q35-84 112-132t168-48q91 0 168 48t112 132q-35 84-112 132T640-40Zm0-80q57 0 107.5-26t82.5-74q-32-48-82.5-74T640-320q-57 0-107.5 26T450-220q32 48 82.5 74T640-120Zm0-40q-25 0-42.5-17.5T580-220q0-25 17.5-42.5T640-280q25 0 42.5 17.5T700-220q0 25-17.5 42.5T640-160Z"/></svg>
                            </a></td>
                            
                        </tr>

                        <?php }  ?>
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
    <div class="mb-3 fs-6">pengguna: <?=$pengguna?> | role: <?=$role?></div>


</div>







<?php
    footerWeb($halaman);
?>