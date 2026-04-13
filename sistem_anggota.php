<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <?php
    // Include functions
    require_once 'functions_anggota.php';
    
    // Data anggota
    $anggota_list = [
        ["id" => 1, "nama" => "Budi", "status" => "Aktif", "total_pinjaman" => 5],
        ["id" => 2, "nama" => "Siti", "status" => "Non-aktif", "total_pinjaman" => 2],
        ["id" => 3, "nama" => "Andi", "status" => "Aktif", "total_pinjaman" => 7],
        ["id" => 4, "nama" => "Rina", "status" => "Aktif", "total_pinjaman" => 3],
        ["id" => 5, "nama" => "Dewi", "status" => "Non-aktif", "total_pinjaman" => 1],
    ];

    // Statistik
    $total = hitung_total_anggota($anggota_list);
    $aktif = hitung_anggota_aktif($anggota_list);
    $nonaktif = $total - $aktif;

    // Anggota teraktif
    $teraktif =cari_anggota_teraktif($anggota_list);

    // Filter
    $anggota_aktif = array_filter($anggota_list, fn($a) => $a['status'] == 'aktif');
    $anggota_nonaktif = array_filter($anggota_list, fn($a) => $a['status'] == 'non-aktif');
    ?>
    
    <div class="container mt-5">
        <h1 class="mb-4"><i class="bi bi-people"></i> Sistem Anggota Perpustakaan</h1>
        
        <!-- Dashboard Statistik -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5>Total Anggota</h5>
                        <h2><?= $total ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5>Anggota Aktif</h5>
                        <h2><?= $aktif ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger shadow">
                    <div class="card-body">
                        <h5>Non-Aktif</h5>
                        <h2><?= $nonaktif ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Anggota -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Anggota</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Total Pinjam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anggota_list as $a): ?>
                        <tr>
                            <td><?= $a['id'] ?></td>
                            <td><?= $a['nama'] ?></td>
                            <td>
                                <span class="badge bg-<?= $a['status'] == 'aktif' ? 'success' : 'secondary' ?>">
                                    <?= $a['status'] ?>
                                </span>
                            </td>
                            <td><?= $a['total_pinjaman'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Anggota Teraktif -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Anggota Teraktif</h5>
            </div>
            <div class="card-body">
                <h4><?= $teraktif['nama'] ?></h4>
                <p>Total Peminjaman: <strong><?= $teraktif['total_pinjaman'] ?></strong></p>
            </div>
        </div>

        <!-- Daftar Aktif & Non-Aktif -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Anggota Aktif
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($anggota_aktif as $a): ?>
                            <li class="list-group-item"><?= $a['nama'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        Anggota Non-Aktif
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($anggota_nonaktif as $a): ?>
                            <li class="list-group-item"><?= $a['nama'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>