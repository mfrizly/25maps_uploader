<?php
session_start();


require_once "helper/csrf_token.php";
require_once "helper/password_view.php";
require_once "helper/redirect_helper.php";



if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == "user") {
       redirect_with("user/index.php");  
    }
    if ($_SESSION['role'] == "admin") {
        redirect_with("admin/index.php");
    }
    if ($_SESSION['role'] == "master") {
        redirect_with("master/index.php");
    }
}

$_SESSION['_auth_access'] = true;

$data = get_redirect_data();
$errors = $data['errors'] ?? [] ;


$csrf_token = generate_csrf_token();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>

    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
     <link rel="icon" type="image/x-icon" href="lib/img/ggf.png">
</head>
<body class="bg-dark-subtle">
    <div class="position-relative" style="height: 100vh; width: 100vw;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="text-center mb-4">
                <img src="lib/img/ggf.png" width="200" alt="" style="pointer-events: none;">
            </div>

            <div class="card bg-light" style="width: 50vw;">
                <div class="card-header text-center">Silahkan Masuk</div>

                <div class="card-body">
                    <form method="post" action="helper/auth.php" class="d-grid gap-3">
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-warning">
                                <ul>
                                    <?php foreach ($errors as $e): ?>
                                        <li><?= htmlspecialchars($e) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        

                        <input type="text" class="form-control" name="username" placeholder="Nama Pengguna" required>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Kata Sandi" required>
                        <input type="hidden" name="csrf_token" value="<?=$csrf_token?>" required>
                        <div>
                            <input type="checkbox" id="togglePassword"> <span>Lihat Kata Sandi</span>
                        </div>
                        <input class="btn btn-primary " type="submit" value="Masuk">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
<!-- Script Toggle Password Start -->
<script>
    passwordViewer("#togglePassword", "#password");
</script>
<!-- Script Toggle Password End -->

<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
