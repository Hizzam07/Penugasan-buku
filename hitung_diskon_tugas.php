<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h1>
        
        <?php
        // Data pembeli
        $nama_pembeli = "Budi Santoso";
        $judul_buku = "Laravel Advanced";
        $harga_satuan = 150000;
        $jumlah_beli = 4;
        $is_member = true;
        
        // Subtotal
        $subtotal = $harga_satuan * $jumlah_beli;
        
        // Persentase diskon
        if ($jumlah_beli >= 1 && $jumlah_beli <= 2) {
            $persentase_diskon = 0;
        } elseif ($jumlah_beli >= 3 && $jumlah_beli <= 5) {
            $persentase_diskon = 0.10;
        } elseif ($jumlah_beli >= 6 && $jumlah_beli <= 10) {
            $persentase_diskon = 0.15;
        } else {
            $persentase_diskon = 0.20;
        }
        
        // Diskon utama
        $diskon = $subtotal * $persentase_diskon;
        
        // Setelah diskon pertama
        $total_setelah_diskon1 = $subtotal - $diskon;
        
        // Diskon member
        $diskon_member = 0;
        if ($is_member) {
            $diskon_member = $total_setelah_diskon1 * 0.05;
        }
        
        // Total setelah semua diskon
        $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;
        
        // PPN 11%
        $ppn = $total_setelah_diskon * 0.11;
        
        // Total akhir
        $total_akhir = $total_setelah_diskon + $ppn;
        
        // Total hemat
        $total_hemat = $diskon + $diskon_member;
        
        // Format rupiah
        function rupiah($angka) {
            return "Rp " . number_format($angka, 0, ',', '.');
        }
        ?>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Detail Pembelian</h4>
            </div>
            <div class="card-body">
                
                <p><strong>Nama Pembeli:</strong> <?= $nama_pembeli ?></p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-<?= $is_member ? 'success' : 'secondary' ?>">
                        <?= $is_member ? 'Member' : 'Non-Member' ?>
                    </span>
                </p>
                
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Judul Buku</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $judul_buku ?></td>
                            <td><?= rupiah($harga_satuan) ?></td>
                            <td><?= $jumlah_beli ?></td>
                            <td><?= rupiah($subtotal) ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <hr>
                
                <p>Subtotal: <strong><?= rupiah($subtotal) ?></strong></p>
                <p>Diskon (<?= $persentase_diskon * 100 ?>%): 
                    <strong><?= rupiah($diskon) ?></strong>
                </p>
                
                <?php if ($is_member): ?>
                    <p>Diskon Member (5%): 
                        <strong><?= rupiah($diskon_member) ?></strong>
                    </p>
                <?php endif; ?>
                
                <p>Total setelah diskon: 
                    <strong><?= rupiah($total_setelah_diskon) ?></strong>
                </p>
                
                <p>PPN (11%): 
                    <strong><?= rupiah($ppn) ?></strong>
                </p>
                
                <h4 class="text-success">
                    Total Akhir: <?= rupiah($total_akhir) ?>
                </h4>
                
                <p class="text-danger">
                    Total Hemat: <?= rupiah($total_hemat) ?>
                </p>
                
            </div>
        </div>
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>