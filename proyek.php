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
    SELECT proyek.*, users.nama, users.nim
    FROM proyek
    JOIN users ON proyek.user_id = users.id
    ORDER BY proyek.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Proyek | PortoCampus</title>

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
                <h2 class="fw-bold mb-1">Semua Proyek</h2>
                <p class="text-muted mb-0">Melihat seluruh proyek mahasiswa.</p>
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
                            <th>Nama Proyek</th>
                            <th>Mata Kuliah</th>
                            <th>Tahun</th>
                            <th>GitHub</th>
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
                                <td><?= htmlspecialchars($row['nama_proyek']); ?></td>
                                <td><?= htmlspecialchars($row['mata_kuliah']); ?></td>
                                <td><?= htmlspecialchars($row['tahun']); ?></td>

                                <td>
                                    <?php if (!empty($row['github'])) { ?>

                                        <a
                                            href="<?= htmlspecialchars($row['github']); ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-dark btn-sm">

                                            <i class="bi bi-github"></i>
                                            Repository
                                        </a>

                                    <?php } else { ?>

                                        <span class="badge bg-secondary">Tidak Ada</span>

                                    <?php } ?>
                                </td>

                                <td>
                                    <a
                                        href="../../controllers/AdminHapusProyek.php?id=<?= (int) $row['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus proyek ini?')">

                                        <i class="bi bi-trash-fill"></i>
                                        Hapus
                                    </a>
                                </td>

                                <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                            </tr>

                        <?php } ?>

                        <?php if ($data->num_rows === 0) { ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">
                                    Belum ada data proyek.
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