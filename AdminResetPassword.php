<?php
session_start();

if (!isset($_SESSION['login']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$password = trim($_POST['password'] ?? '');
$konfirmasi = trim($_POST['konfirmasi_password'] ?? '');

if ($id <= 0 || $password === '' || $password !== $konfirmasi) {
    header("Location: ../views/admin/users.php");
    exit;
}

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->bind_param("si", $password, $id);
$stmt->execute();

header("Location: ../views/admin/users.php");
exit;