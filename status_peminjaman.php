<?php
// Data Anggota
$nama_anggota = "Budi Santoso";
$total_pinjaman = 2;
$buku_terlambat = 1;
$hari_keterlambatan = 5; // hari

// Konstanta
$max_pinjam = 3;
$denda_per_hari = 1000;
$max_denda = 50000;

// Menghitung denda
$total_denda = 0;
if ($buku_terlambat > 0) {
    $total_denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;

    if ($total_denda > $max_denda) {
        $total_denda = $max_denda;
    }
}

// Status peminjaman
$status = "";
$status_class = "";

if ($buku_terlambat > 0) {
    $status = "Tidak bisa meminjam (ada keterlambatan)";
    $status_class = "danger";
} elseif ($total_pinjaman >= $max_pinjam) {
    $status = "Tidak bisa meminjam (batas maksimal tercapai)";
    $status_class = "warning";
} else {
    $status = "Boleh meminjam buku";
    $status_class = "success";
}

// Level member
switch (true) {
    case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
        $level = "Bronze";
        break;
    case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
        $level = "Silver";
        break;
    case ($total_pinjaman > 15):
        $level = "Gold";
        break;
    default:
        $level = "Tidak diketahui";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        
        <div class="card-header bg-primary text-white text-center">
            <h3>Status Peminjaman Perpustakaan</h3>
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Nama:</strong> <?= $nama_anggota; ?></p>
                    <p><strong>Total Peminjaman:</strong> <?= $total_pinjaman; ?></p>
                    <p><strong>Level Member:</strong> 
                        <span class="badge bg-secondary"><?= $level; ?></span>
                    </p>
                </div>

                <div class="col-md-6">
                    <p><strong>Buku Terlambat:</strong> <?= $buku_terlambat; ?></p>
                    <p><strong>Hari Keterlambatan:</strong> <?= $hari_keterlambatan; ?> hari</p>
                </div>
            </div>

            <hr>

            <!-- Status -->
            <div class="alert alert-<?= $status_class; ?>">
                <strong>Status:</strong> <?= $status; ?>
            </div>

            <!-- Peringatan -->
            <?php if ($buku_terlambat > 0): ?>
                <div class="alert alert-danger">
                    ⚠️ Anda memiliki keterlambatan!
                    <br>
                    Total Denda: <strong>Rp <?= number_format($total_denda, 0, ',', '.'); ?></strong>
                </div>
            <?php endif; ?>

        </div>

        <div class="card-footer text-center text-muted">
            Sistem Perpustakaan © <?= date("Y"); ?>
        </div>

    </div>
</div>

</body>
</html>