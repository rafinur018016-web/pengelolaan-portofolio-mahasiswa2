<?php
$current = basename($_SERVER['PHP_SELF']);
?>

<div class="admin-sidebar">

    <div class="admin-brand">
        <i class="bi bi-shield-lock-fill"></i>
        PortoAdmin
    </div>

    <a href="dashboard.php" class="<?= $current == 'dashboard.php' ? 'active' : '' ?>">
        <i class="bi bi-grid-fill"></i>
        Dashboard
    </a>

    <a href="users.php" class="<?= $current == 'users.php' ? 'active' : '' ?>">
        <i class="bi bi-people-fill"></i>
        Kelola User
    </a>

    <a href="sertifikat.php" class="<?= $current == 'sertifikat.php' ? 'active' : '' ?>">
        <i class="bi bi-award-fill"></i>
        Semua Sertifikat
    </a>

    <a href="prestasi.php" class="<?= $current == 'prestasi.php' ? 'active' : '' ?>">
        <i class="bi bi-trophy-fill"></i>
        Semua Prestasi
    </a>

    <a href="proyek.php" class="<?= $current == 'proyek.php' ? 'active' : '' ?>">
        <i class="bi bi-laptop-fill"></i>
        Semua Proyek
    </a>

    <hr class="text-white-50 my-4">

    <a href="../dashboard.php">
        <i class="bi bi-person-fill"></i>
        Dashboard User
    </a>

    <a href="../../controllers/LogoutController.php">
        <i class="bi bi-box-arrow-right"></i>
        Logout
    </a>

    <div class="mt-4 text-white-50 small">
        PortoCampus Admin V2
    </div>

</div>