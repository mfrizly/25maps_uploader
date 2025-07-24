<?php
    $pengguna = "Master";
    $role = "master";
    $halaman = "pengaturan_pengguna";
    $judul_halaman = "Pengaturan Pengguna";

    require_once "../helper/header.php";
    require_once "../helper/footer.php";
    require_once "../helper/password_view.php";


?>

<div class="container">

    <hr>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan Pengguna</li>
        </ol>
    </nav>

    <div class="accordion mb-4" id="accordionGantiPassword">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Ganti Password Master
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionGantiPassword">
                <div class="accordion-body">
                <form method="post" class=" d-grid gap-3">
                    <input type="password" class="form-control" id="passwordPertama" name="password_pertama" placeholder="Masukkan Password Baru">
                    <input type="password" class="form-control" id="passwordKedua" name="password_kedua" placeholder="Ulangi Password Baru">
                    <div>
                        <input type="checkbox" id="togglePassword"> <span>Lihat Kata Sandi</span>
                    </div>
                    <input type="submit" class="form-control btn btn-primary" value="Ganti">
                </form>
                </div>
            </div>
        </div>
    </div>



    <div class="card mb-4">
        <div class="card-header fw-bold">Buat Pengguna</div>
        <div class="card-body">
            <form method="post" class=" d-grid gap-3">
            <div>
                <select name="role" id="role" class="form-select">
                    <option selected>Pilih Role Pengguna..</option>
                    <option value="admin">Admin</option>
                    <option value="user">Pengguna Biasa</option>
                </select>    
            </div>    
            
                <input type="text" class="form-control" name="username" placeholder="Masukkan Nama Pengguna">
                <input type="password" class="form-control" id="passwordUser" name="password_user" placeholder="Masukkan Kata Sandi">
                <div>
                    <input type="checkbox" id="togglePasswordUser"> <span>Lihat Kata Sandi</span>
                </div>
                <input type="submit" class="form-control btn btn-primary" value="Tambah">
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">List Pengguna</div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablePengguna" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-danger" href="#">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    

    <hr>
    <div class="mb-3">role: <?=$role?></div>
</div>





<!-- Script Toggle Password Start -->
<script>

    passwordViewer("#togglePassword", "#passwordPertama");
    passwordViewer("#togglePassword", "#passwordKedua");
    passwordViewer("#togglePasswordUser", "#passwordUser");
    

</script>
<!-- Script Toggle Password End -->

<?php
    footerWeb($halaman);
?>