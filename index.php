<?php
require_once "helper/password_view.php";


session_start();
require_once "helper/csrf_token.php";
$csrf_token = generate_csrf_token();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == "user") {
        header("Location: user/index.php");
        exit;    
    }
    if ($_SESSION['role'] == "admin") {
        header("Location: admin/index.php");
        exit;    
    }
    if ($_SESSION['role'] == "master") {
        header("Location: master/index.php");
        exit;    
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>

    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-dark-subtle">
    <div class="position-relative" style="height: 100vh; width: 100vw;">
        <div class="position-absolute top-50 start-50 translate-middle">
            <div class="card bg-light" style="width: 50vw;">
                <div class="card-header text-center">Silahkan Masuk</div>

                <div class="card-body">
                    <form method="post" action="helper/auth.php" class="d-grid gap-3">
                        
                        <?php
                            if (isset($_SESSION['errors'])) { 
                        ?>
                            <div class="alert alert-warning">
                                <ul>
                                    <?php 
                                    foreach ($_SESSION['errors'] as $e) { ?>
                                            <li><?=htmlspecialchars($e)?></li>
                                    <?php 
                                        }
                                    ?>
                                </ul>
                        </div>
                        <?php
                            unset($_SESSION['errors']);
                            } else { $error = null; }
                        ?>

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