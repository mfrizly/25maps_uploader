<?php
    session_start();
    $_SESSION['_pengaturan_pengguna'] = true;

    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "list";
    $judul_halaman = "Pengaturan Pengguna - $pengguna";

    require_once "../helper/header.php";
    require_once "../helper/footer.php";
    require_once "../helper/password_view.php";
   
    require_once "../database/database.php";
    require_once "../database/read.php";
    
    require_once "../helper/csrf_token.php";
    require_once "../helper/redirect_helper.php";
    
    $csrf_token = generate_csrf_token();

    $data = get_redirect_data();
    $pesans = $data["pesans"] ?? [];


?>

<div class="container">

    <h1><?=$judul_halaman?></h1>

    <hr>
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan Pengguna</li>
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

    <div class="accordion mb-4" id="accordionGantiPassword">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Ganti Password Admin
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionGantiPassword">
                <div class="accordion-body">
                <form method="post" action="../admin_model/update_password_admin.php" class="d-grid gap-3">
                    <input type="password" class="form-control" id="passwordPertama" name="password_pertama" placeholder="Masukkan Password Baru" required>
                    <input type="password" class="form-control" id="passwordKedua" name="password_kedua" placeholder="Ulangi Password Baru" required aria-describedby="passwordAdminHelp">
                    <div id="passwordAdminHelp" class="form-text">Password harus mengandung 1 huruf besar, 1 huruf kecil, 1 simbol, 1 angka dan minimal 8 karakter</div>
                    <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
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
            <form method="post" action="../admin_model/buat_pengguna.php" class=" d-grid gap-3">            
                <input type="text" class="form-control" name="username" placeholder="Masukkan Nama Pengguna" required>
                <input type="password" class="form-control" id="passwordUser" name="password_user" placeholder="Masukkan Kata Sandi" required aria-describedby="passwordHelp">
                <div id="passwordHelp" class="form-text">Password harus mengandung 1 huruf besar, 1 huruf kecil, 1 simbol, 1 angka dan minimal 8 karakter</div>
                <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
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
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                            $conn = get_connection();
                            $query = "SELECT id, username, role FROM users WHERE role='user' ORDER BY id ASC";
                            $data = read($conn, $query);
                            foreach ($data as $user) {
                        ?>
                        
                        <tr>
                            <td><?=$user['username'];?></td>
                            <td><?=$user['role'];?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-primary" href="edit_pengguna.php?id=<?=$user["id"]?>">Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="../admin_model/hapus_pengguna.php?id=<?=$user["id"]?>&username=<?=$user['username']?>">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <?php
                            }
                        ?>
                       
                    
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
    <div class="mb-3 fs-6">pengguna: <?=$pengguna?> | role: <?=$role?></div>
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