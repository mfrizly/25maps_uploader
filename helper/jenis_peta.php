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

function jenisPeta($pgaw = 0, $pgajt = 0, $pgakapg = 0, $pgp = 0, $pgsknu = 0, $pgst = 0, $ba = 0){ ?>
<div class="row row-cols-1 row-cols-md-3 g-3 my-3">
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1"><?=$pgaw?></div>
                    </div>
                    <div class="card-footer">
                        <div class="fw-bold float-start">Peta Global Area Wilayah</div>
                        <a href="list_peta.php?j=PGAW" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1"><?=$pgajt?></div>
                    </div>
                    <div class="card-footer">
                        <div class="fw-bold float-start">Peta Global Area Jenis Tanaman</div>
                        <a href="list_peta.php?j=PGAJT" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1"><?=$pgakapg?></div>
                    </div>
                    <div class="card-footer">
                        <div class="fw-bold float-start">Peta Global Area Komoditi All PG</div>
                        <a href="list_peta.php?j=PGAKAPG" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1"><?=$pgp?></div>
                    </div>
                    <div class="card-footer">
                        <div class="fw-bold float-start">Peta Global Polos</div>
                        <a href="list_peta.php?j=PGP" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1"><?=$pgsknu?></div>
                    </div>
                    <div class="card-footer">
                        <div class="fw-bold float-start">Peta Global Selain Komoditi Non Utama</div>
                        <a href="list_peta.php?j=PGSKNU" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1"><?=$pgst?></div>
                    </div>
                    <div class="card-footer">
                        <div class="fw-bold float-start">Peta Global Status Tanaman</div>
                        <a href="list_peta.php?j=PGST" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1"><?=$ba?></div>
                    </div>
                    <div class="card-footer">
                        <div class="fw-bold float-start">Bolder Area</div>
                        <a href="list_peta.php?j=BA" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="col">
        <div class="card">
            <div class="card-body">
                <img class="card-img-bottom" src="../lib/img/peta_dashboard.jpeg" loading="lazy" style="pointer-events: none;">
            </div>
        </div>
    </div>



<?php } ?>
