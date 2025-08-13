<?php

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}

function countDataPeta($jenis){
        $conn = get_connection();
        $query = "SELECT COUNT(jenis_peta) as jumlah FROM data_peta WHERE jenis_peta = ?";
        $data = read($conn, $query, "s", [$jenis]);
        $nilai = strval($data[0]['jumlah']);
        return $nilai;
}

function jenisPeta($pgaw = 0, $pgajt = 0, $pgakapg = 0, $pgp = 0, $pgsknu = 0, $pgst = 0){ ?>
<div class="row row-cols-1 row-cols-md-3 g-3 my-3">
        <div class="col">
            <div class="card card-hover h-100">
                <div class="card-body">
                    <div class="fs-1">Peta Global Area Wilayah</div>
                    <div class="card-footer">
                        <a href="list_peta.php?j=PGAW" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover h-100">
                <div class="card-body">
                    <div class="fs-1">Peta Global Area Jenis Tanaman</div>
                    <div class="card-footer">
                        <a href="list_peta.php?j=PGAJT" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover h-100">
                <div class="card-body">
                    <div class="fs-1">Peta Global Area Komoditi All PG</div>
                    <div class="card-footer">
                        <a href="list_peta.php?j=PGAKAPG" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover h-100">
                <div class="card-body">
                    <div class="fs-1">Peta Global Selain Komoditi Non Utama</div>
                    <div class="card-footer">
                        <a href="list_peta.php?j=PGSKNU" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover h-100">
                <div class="card-body">
                    <div class="fs-1">Peta Global Status Tanaman</div>
                    
                    <div class="card-footer">
                        <a href="list_peta.php?j=PGST" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover h-100">
                <div class="card-body">
                    <div class="fs-1">Peta Global <div class="text-break"> Polos</div></div>
                    <div class="card-footer align-self-end">
                        <a href="list_peta.php?j=PGP" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php } ?>

<?php
function dashboardPeta($pgaw = 0, $pgajt = 0, $pgakapg = 0, $pgp = 0, $pgsknu = 0, $pgst = 0,){ ?>
    <div class="row row-cols-1 row-cols-md-2 g-3 my-3">
        <div class="col">
            <div class="card gradient-card">
                <div class="card-header fw-bold">Peta Global Area Wilayah</div>
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1 fw-bold"><?=$pgaw?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card gradient-card">
                <div class="card-header fw-bold">Peta Global Area Jenis Tanaman</div>
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1 fw-bold"><?=$pgajt?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card gradient-card">
                <div class="card-header fw-bold">Peta Global Area Komoditi ALL PG</div>
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1 fw-bold"><?=$pgakapg?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card gradient-card">
                <div class="card-header fw-bold">Peta Global Polos</div>
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1 fw-bold"><?=$pgp?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card gradient-card">
                <div class="card-header fw-bold">Peta Global Selain Komoditi Non Utama</div>
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1 fw-bold"><?=$pgsknu?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card gradient-card">
                <div class="card-header">Peta Global Status Tanaman</div>
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1 fw-bold"><?=$pgst?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php } ?>
