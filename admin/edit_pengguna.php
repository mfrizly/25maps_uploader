<?php
    session_start();
    $_SESSION['_edit_pengguna'] = true;

    
    require_once "../helper/session_protect.php";
    allow_role(['admin']);

   

    $pengguna = htmlspecialchars($_SESSION['user']);
    $role = htmlspecialchars($_SESSION['role']);
    $halaman = "edit_pengguna";
    $judul_halaman = "Edit Pengguna - Admin";

    require_once "../helper/header.php";
    require_once "../helper/footer.php";
    require_once "../helper/password_view.php";
   
    require_once "../database/database.php";
    require_once "../database/read.php";
    
    require_once "../helper/csrf_token.php";
    require_once "../helper/redirect_helper.php";
    
    if (!isset($_GET['id'])){
        redirect_with("pengaturan_pengguna.php");
    } else {
        $id = $_GET['id'];

        $conn = get_connection();
        $query = "SELECT username FROM users WHERE id = ?";
        $data = read($conn, $query, "i", [$id]);
    }

    $csrf_token = generate_csrf_token();

         

?>

<div class="container">


    <h1><?=$judul_halaman?></h1>

    <hr>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active"><a href="pengaturan_pengguna.php"> Pengaturan Pengguna</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pengguna</li>
        </ol>
    </nav>

    <?php foreach ($data as $d) { ?>    
    
    <div class="card mb-4">
        <div class="card-header fw-bold">Edit Pengguna</div>
        <div class="card-body">
        
            <form method="post" action="../admin_model/edit_pengguna.php" class=" d-grid gap-3">            
                <input type="text" class="form-control" name="username" placeholder="Masukkan Nama Pengguna" value="<?=$d['username']?>" required>
                <input type="password" class="form-control" id="passwordUser" name="password_user" placeholder="Masukkan Kata Sandi" aria-describedby="passwordHelp" required>
                <div id="passwordHelp" class="form-text">Password harus mengandung 1 huruf besar, 1 huruf kecil, 1 simbol, 1 angka dan minimal 8 karakter</div>
                <input type="hidden" name="id" value="<?=$id?>" required>
                <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
                <div>
                    <input type="checkbox" id="togglePasswordUser"> <span>Lihat Kata Sandi</span>
                </div>
                <input type="submit" class="form-control btn btn-primary" value="Ganti">
            </form>
        </div>
    </div>


    <?php
    }
    ?>

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