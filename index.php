<?php
require_once "helper/password_view.php";
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
                    <form method="post" class="d-grid gap-3">
                        <input type="text" class="form-control" name="username" placeholder="Nama Pengguna">
                        <input type="password" id="password" class="form-control" name="password" placeholder="Kata Sandi">
                        <input type="hidden" name="token">
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