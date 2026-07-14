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

$data = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola User | PortoCampus</title>

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
                <h2 class="fw-bold mb-1">Kelola User</h2>

                <p class="text-muted mb-0">
                    Mengatur role, status, dan akses pengguna PortoCampus.
                </p>
            </div>

            <div>
                <span class="badge bg-primary">
                    <i class="bi bi-shield-check"></i>
                    <?= htmlspecialchars($_SESSION['nama']); ?>
                </span>
            </div>

        </div>

        <div class="card-panel">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                <div>
                    <h4 class="fw-bold mb-1">
                        <i class="bi bi-people-fill text-primary"></i>
                        Daftar Pengguna
                    </h4>

                    <small class="text-muted">
                        Total <?= $data->num_rows; ?> akun terdaftar
                    </small>
                </div>

                <a href="dashboard.php" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i>
                    Dashboard
                </a>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th style="min-width:230px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 1;

                        while ($d = $data->fetch_assoc()) {
                            $isSelf = ((int) $d['id'] === (int) $_SESSION['user_id']);
                        ?>

                            <tr>

                                <td><?= $no++; ?></td>

                                <td>
                                    <strong><?= htmlspecialchars($d['nama']); ?></strong>

                                    <?php if ($isSelf) { ?>
                                        <span class="badge bg-info text-dark ms-1">Akun Saya</span>
                                    <?php } ?>
                                </td>

                                <td><?= htmlspecialchars($d['nim']); ?></td>

                                <td><?= htmlspecialchars($d['email']); ?></td>

                                <td>
                                    <?php if ($d['role'] === "admin") { ?>

                                        <span class="badge bg-danger">
                                            <i class="bi bi-shield-lock-fill"></i>
                                            ADMIN
                                        </span>

                                    <?php } else { ?>

                                        <span class="badge bg-primary">
                                            <i class="bi bi-person-fill"></i>
                                            USER
                                        </span>

                                    <?php } ?>
                                </td>

                                <td>
                                    <?php if ($d['status'] === "aktif") { ?>

                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle-fill"></i>
                                            AKTIF
                                        </span>

                                    <?php } else { ?>

                                        <span class="badge bg-secondary">
                                            <i class="bi bi-slash-circle-fill"></i>
                                            DIBLOKIR
                                        </span>

                                    <?php } ?>
                                </td>

                                <td>

                                    <?php if (!$isSelf) { ?>

                                        <a
                                            href="../../controllers/UbahRole.php?id=<?= (int) $d['id']; ?>"
                                            class="btn btn-warning btn-sm mb-1"
                                            onclick="return confirm('Yakin ingin mengubah role akun ini?')">

                                            <i class="bi bi-arrow-repeat"></i>
                                            Ubah Role
                                        </a>

                                        <?php if ($d['status'] === "aktif") { ?>

                                            <a
                                                href="../../controllers/BlokirUser.php?id=<?= (int) $d['id']; ?>"
                                                class="btn btn-danger btn-sm mb-1"
                                                onclick="return confirm('Yakin ingin memblokir akun ini?')">

                                                <i class="bi bi-person-fill-slash"></i>
                                                Blokir
                                            </a>

                                            <a
                                                href="reset_password.php?id=<?= (int) $d['id']; ?>"
                                                class="btn btn-info btn-sm mb-1">

                                                <i class="bi bi-key-fill"></i>
                                                Reset Password
                                            </a>

                                        <?php } else { ?>

                                            <a
                                                href="../../controllers/BlokirUser.php?id=<?= (int) $d['id']; ?>"
                                                class="btn btn-success btn-sm mb-1"
                                                onclick="return confirm('Aktifkan kembali akun ini?')">

                                                <i class="bi bi-person-check-fill"></i>
                                                Aktifkan
                                            </a>

                                        <?php } ?>

                                    <?php } else { ?>

                                        <button class="btn btn-secondary btn-sm" disabled>
                                            Tidak dapat diubah
                                        </button>

                                    <?php } ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>