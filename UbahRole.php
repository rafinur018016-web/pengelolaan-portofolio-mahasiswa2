<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../views/login.php");
    exit;
}

if (($_SESSION['role'] ?? '') !== "admin") {
    header("Location: ../views/dashboard.php");
    exit;
}

require_once "../config/Database.php";

$db = new Database();
$conn = $db->connect();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0 || $id === (int) $_SESSION['user_id']) {
    header("Location: ../views/admin/users.php");
    exit;
}

$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: ../views/admin/users.php");
    exit;
}

$roleBaru = ($user['role'] === "admin") ? "user" : "admin";

$stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
$stmt->bind_param("si", $roleBaru, $id);
$stmt->execute();

header("Location: ../views/admin/users.php");
exit;