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

$data = $conn->query("
    SELECT prestasi.*, users.nama, users.nim
    FROM prestasi
    JOIN users ON prestasi.user_id = users.id
    ORDER BY prestasi.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Prestasi | PortoCampus</title>

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
                <h2 class="fw-bold mb-1">Semua Prestasi</h2>
                <p class="text-muted mb-0">Melihat seluruh prestasi mahasiswa.</p>
            </div>
        </div>

        <div class="card-panel">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Nama Prestasi</th>
                            <th>Tingkat</th>
                            <th>Tahun</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $no = 1;
                        while ($row = $data->fetch_assoc()) { ?>

                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama']); ?></td>
                                <td><?= htmlspecialchars($row['nim']); ?></td>
                                <td><?= htmlspecialchars($row['nama_prestasi']); ?></td>
                                <td><?= htmlspecialchars($row['tingkat']); ?></td>
                                <td><?= htmlspecialchars($row['tahun']); ?></td>
                                <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                                <td>
                                    <a
                                        href="../../controllers/AdminHapusPrestasi.php?id=<?= (int) $row['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus prestasi ini?')">

                                        <i class="bi bi-trash-fill"></i>
                                        Hapus
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>

                        <?php if ($data->num_rows === 0) { ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Belum ada data prestasi.
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