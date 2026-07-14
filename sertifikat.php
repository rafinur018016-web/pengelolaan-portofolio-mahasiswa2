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
    SELECT sertifikat.*, users.nama, users.nim
    FROM sertifikat
    JOIN users ON sertifikat.user_id = users.id
    ORDER BY sertifikat.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Sertifikat | PortoCampus</title>

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
                <h2 class="fw-bold mb-1">Semua Sertifikat</h2>
                <p class="text-muted mb-0">Melihat seluruh sertifikat mahasiswa.</p>
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
                            <th>Nama Sertifikat</th>
                            <th>Penyelenggara</th>
                            <th>Tahun</th>
                            <th>PDF</th>
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
                                <td><?= htmlspecialchars($row['nama_sertifikat']); ?></td>
                                <td><?= htmlspecialchars($row['penyelenggara']); ?></td>
                                <td><?= htmlspecialchars($row['tahun']); ?></td>

                                <td>
                                    <?php if (!empty($row['file_pdf'])) { ?>

                                        <a
                                            href="../../assets/uploads/sertifikat/<?= urlencode($row['file_pdf']); ?>"
                                            target="_blank"
                                            class="btn btn-danger btn-sm">

                                            <i class="bi bi-file-earmark-pdf-fill"></i>
                                            Lihat PDF
                                        </a>

                                    <?php } else { ?>

                                        <span class="badge bg-secondary">Tidak Ada</span>

                                    <?php } ?>
                                </td>

                                <td>
                                    <a
                                        href="../../controllers/AdminHapusSertifikat.php?id=<?= (int) $row['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus sertifikat ini?')">

                                        <i class="bi bi-trash-fill"></i>
                                        Hapus
                                    </a>
                                </td>
                            </tr>

                        <?php } ?>

                        <?php if ($data->num_rows === 0) { ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Belum ada data sertifikat.
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