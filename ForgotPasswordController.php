<?php

require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

$email = $_POST['email'];

$cek = $conn->query("
SELECT *
FROM users
WHERE email='$email'
");

if($cek->num_rows > 0){

    header("Location: ../views/forgot_password.php?status=ada");
    exit;

}else{

    header("Location: ../views/forgot_password.php?status=tidak");
    exit;

}