<?php
    session_start();
    
    require_once "../helper/session_protect.php";
    allow_role(['user']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "list";
    $judul_halaman = "List Peta - $pengguna";
    $jenis_peta = htmlspecialchars($_GET['j']);


    require_once "../helper/header.php";
    require_once "../helper/footer.php";
    require_once "../helper/redirect_helper.php";

    require_once "../database/database.php";
    require_once "../database/read.php";
    

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
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $conn = get_connection();
                            $query = "SELECT id, pg, tanggal_upload, jenis_peta, nama_peta FROM data_peta WHERE jenis_peta = ?";
                            $datas = read($conn, $query, "s", [$jenis_peta]);

                            $no = 1;
                        
                            foreach ($datas as $d) {
                                
                            
                        ?>

                        <tr>
                            <td><?=$no++?></td>
                            <td><?=kamusPeta($d['jenis_peta'])?></td>
                            <td><a href="data_peta.php?id=<?=$d['id']?>&j=<?=$jenis_peta?>"> <?=$d['nama_peta']?> </a></td>
                            <td><?=$d['pg']?></td>
                            <td><?=$d['tanggal_upload']?></td>
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