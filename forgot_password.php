<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Lupa Password | PortoCampus</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#2563eb,#4f46e5,#7c3aed);
    font-family:Poppins,Arial,sans-serif;
    padding:20px;
}
.card-reset{
    width:100%;
    max-width:430px;
    background:white;
    border-radius:24px;
    padding:35px;
    box-shadow:0 25px 60px rgba(0,0,0,.25);
}
.btn-reset{
    height:52px;
    border-radius:14px;
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    border:none;
}
</style>
</head>

<body>

<div class="card-reset">

<h3 class="fw-bold text-center mb-2">
<i class="bi bi-key-fill text-primary"></i>
Lupa Password
</h3>

<p class="text-center text-muted">
Masukkan email akun PortoCampus Anda.
</p>

<?php if(isset($_GET['status'])){ ?>

<div class="alert alert-info text-center">

<?php
if($_GET['status']=="ada"){
    echo "Email ditemukan. Silakan hubungi admin untuk reset password.";
}elseif($_GET['status']=="tidak"){
    echo "Email belum terdaftar. Silakan daftar terlebih dahulu.";
}
?>

</div>

<?php } ?>

<form action="../controllers/ForgotPasswordController.php" method="POST">

<div class="mb-3">
<label class="form-label fw-bold">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary btn-reset w-100">
<i class="bi bi-send-fill"></i>
Kirim Permintaan
</button>

</form>

<div class="text-center mt-4">
<a href="login.php" class="text-decoration-none">
<i class="bi bi-arrow-left"></i>
Kembali ke Login
</a>
</div>

</div>

</body>
</html>