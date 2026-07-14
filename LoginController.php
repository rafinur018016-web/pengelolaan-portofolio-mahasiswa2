<?php

session_start();

require_once "../config/Database.php";
require_once "../models/User.php";

$db = new Database();
$conn = $db->connect();

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$cekEmail = $conn->query("SELECT * FROM users WHERE email='$email'");

if ($cekEmail->num_rows == 0) {
    header("Location: ../views/login.php?error=notfound");
    exit;
}

$user = $cekEmail->fetch_assoc();

if ($user['status'] == "blokir") {
    header("Location: ../views/login.php?error=blokir");
    exit;
}

if ($user['password'] != $password) {
    header("Location: ../views/login.php?error=password");
    exit;
}

if ($user['role'] != $role) {
    header("Location: ../views/login.php?error=role");
    exit;
}

$_SESSION['login'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['nama'] = $user['nama'];
$_SESSION['email'] = $user['email'];
$_SESSION['nim'] = $user['nim'];
$_SESSION['foto'] = $user['foto'];
$_SESSION['role'] = $user['role'];

if ($user['role'] == "admin") {
    header("Location: ../views/admin/dashboard.php");
} else {
    header("Location: ../views/dashboard.php");
}

exit;