<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['role'] != "admin") {
    header("Location: ../dashboard.php");
    exit;
}

require_once "../../config/Database.php";

$db = new Database();
$conn = $db->connect();

$totalUser = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalAdmin = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='admin'")->fetch_assoc()['total'];
$totalBlocked = $conn->query("SELECT COUNT(*) AS total FROM users WHERE status='blokir'")->fetch_assoc()['total'];
$totalSertifikat = $conn->query("SELECT COUNT(*) AS total FROM sertifikat")->fetch_assoc()['total'];
$totalPrestasi = $conn->query("SELECT COUNT(*) AS total FROM prestasi")->fetch_assoc()['total'];
$totalProyek = $conn->query("SELECT COUNT(*) AS total FROM proyek")->fetch_assoc()['total'];

$users = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | PortoCampus</title>

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
            <h2 class="fw-bold mb-1">Dashboard Admin</h2>
            <p class="text-muted mb-0">
                Kelola seluruh data PortoCampus dan pantau aktivitas pengguna.
            </p>
        </div>

        <div class="text-end">
            <span class="badge bg-primary">
                <i class="bi bi-person-circle"></i>
                <?= $_SESSION['nama']; ?>
            </span>
        </div>
    </div>

    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#2563eb,#4f46e5);">
                <h5>Total User</h5>
                <h2><?= $totalUser; ?></h2>
                <i class="bi bi-people-fill fs-2"></i>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#ef4444,#dc2626);">
                <h5>Admin</h5>
                <h2><?= $totalAdmin; ?></h2>
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#64748b,#334155);">
                <h5>Akun Diblokir</h5>
                <h2><?= $totalBlocked; ?></h2>
                <i class="bi bi-person-fill-slash fs-2"></i>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#10b981,#059669);">
                <h5>Sertifikat</h5>
                <h2><?= $totalSertifikat; ?></h2>
                <i class="bi bi-award-fill fs-2"></i>
            </div>
        </div>

    </div>

    <div class="row mb-4">

        <div class="col-md-4 mb-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#ec4899,#db2777);">
                <h5>Prestasi</h5>
                <h2><?= $totalPrestasi; ?></h2>
                <i class="bi bi-trophy-fill fs-2"></i>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#f59e0b,#d97706);">
                <h5>Proyek</h5>
                <h2><?= $totalProyek; ?></h2>
                <i class="bi bi-laptop-fill fs-2"></i>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#7c3aed,#4f46e5);">
                <h5>Total Portofolio</h5>
                <h2><?= $totalSertifikat + $totalPrestasi + $totalProyek; ?></h2>
                <i class="bi bi-folder-fill fs-2"></i>
            </div>
        </div>

    </div>

    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <a href="users.php" class="quick-card">
                <i class="bi bi-people-fill text-primary"></i>
                <h5 class="fw-bold">Kelola User</h5>
                <p class="text-muted mb-0">Ubah role dan blokir akun.</p>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="sertifikat.php" class="quick-card">
                <i class="bi bi-award-fill text-success"></i>
                <h5 class="fw-bold">Sertifikat</h5>
                <p class="text-muted mb-0">Lihat semua sertifikat.</p>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="prestasi.php" class="quick-card">
                <i class="bi bi-trophy-fill text-danger"></i>
                <h5 class="fw-bold">Prestasi</h5>
                <p class="text-muted mb-0">Pantau prestasi mahasiswa.</p>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="proyek.php" class="quick-card">
                <i class="bi bi-laptop-fill text-warning"></i>
                <h5 class="fw-bold">Proyek</h5>
                <p class="text-muted mb-0">Lihat proyek mahasiswa.</p>
            </a>
        </div>

    </div>

    <div class="card-panel">

        <h4 class="fw-bold mb-3">
            <i class="bi bi-clock-history"></i>
            User Terbaru
        </h4>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; while ($row = $users->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['nim']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <?php if ($row['role'] == "admin") { ?>
                                <span class="badge bg-danger">Admin</span>
                            <?php } else { ?>
                                <span class="badge bg-primary">User</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == "aktif") { ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php } else { ?>
                                <span class="badge bg-secondary">Diblokir</span>
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