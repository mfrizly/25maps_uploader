<?php

    $pengguna = "Master";
    $role = "master";
    $halaman = "edit";
    $judul_halaman = "Edit Peta - Master";

    require_once "../helper/footer.php";
    require_once "../helper/header.php";

?>

<div class="container">

    <hr>


    <div class="row row-cols-1 row-cols-md-2 g-3 my-3">
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1">Peta Global Area Wilayah</div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1">Peta Global Area Jenis Tanaman</div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1">Peta Global Area Komoditi All PG</div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1">Peta Global Polos</div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1">Peta Global Selain Komoditi Non Utama</div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1">Peta Global Status Tanaman</div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card card-hover">
                <div class="card-body">
                    <div class="card-title">
                        <div class="fs-1">Bolder Area</div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="float-end"> <span class="material-symbols-outlined">arrow_outward</span> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    <div class="mb-3">role: <?=$role?></div>



    
    
</div>




<?php
    footerWeb($halaman);
?>