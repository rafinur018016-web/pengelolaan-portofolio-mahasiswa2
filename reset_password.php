<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if (($_SESSION['role'] ?? '') !== "admin") {
    header("Location: ../dashboard.php");
    exit;
}

require_once "../../config/Database.php";

$db = new Database();
$conn = $db->connect();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $conn->prepare("SELECT id, nama, email FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    header("Location: users.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | PortoCampus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <?php include "style_admin.php"; ?>
</head>

<body>

<?php include "sidebar.php"; ?>

<div class="admin-content">

    <div class="admin-navbar">
        <div>
            <h2 class="fw-bold mb-1">Reset Password User</h2>
            <p class="text-muted mb-0">
                Mengubah password akun pengguna.
            </p>
        </div>
    </div>

    <div class="card-panel">

        <h4 class="fw-bold mb-3">
            <i class="bi bi-key-fill text-primary"></i>
            <?= htmlspecialchars($user['nama']); ?>
        </h4>

        <p class="text-muted">
            <?= htmlspecialchars($user['email']); ?>
        </p>

        <form action="../../controllers/AdminResetPassword.php" method="POST">

            <input type="hidden" name="id" value="<?= (int) $user['id']; ?>">

            <div class="mb-3">
                <label class="form-label fw-bold">Password Baru</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    minlength="6"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Konfirmasi Password</label>

                <input
                    type="password"
                    name="konfirmasi_password"
                    class="form-control"
                    minlength="6"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save-fill"></i>
                Simpan Password
            </button>

            <a href="users.php" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

</body>
</html>