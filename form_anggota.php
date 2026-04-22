<?php
// form_anggota.php

$errors = [];
$success = false;

// Inisialisasi variabel
$nama = "";
$email = "";
$telepon = "";
$alamat = "";
$jk = "";
$tgl_lahir = "";
$pekerjaan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama       = trim($_POST["nama"]);
    $email      = trim($_POST["email"]);
    $telepon    = trim($_POST["telepon"]);
    $alamat     = trim($_POST["alamat"]);
    $jk         = $_POST["jk"] ?? "";
    $tgl_lahir  = $_POST["tgl_lahir"];
    $pekerjaan  = $_POST["pekerjaan"];

    // Validasi Nama
    if (empty($nama)) {
        $errors["nama"] = "Nama lengkap wajib diisi.";
    } elseif (strlen($nama) < 3) {
        $errors["nama"] = "Nama minimal 3 karakter.";
    }

    // Validasi Email
    if (empty($email)) {
        $errors["email"] = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Format email tidak valid.";
    }

    // Validasi Telepon
    if (empty($telepon)) {
        $errors["telepon"] = "Telepon wajib diisi.";
    } elseif (!preg_match('/^08[0-9]{8,11}$/', $telepon)) {
        $errors["telepon"] = "Format telepon harus 08xxxxxxxxxx (10-13 digit).";
    }

    // Validasi Alamat
    if (empty($alamat)) {
        $errors["alamat"] = "Alamat wajib diisi.";
    } elseif (strlen($alamat) < 10) {
        $errors["alamat"] = "Alamat minimal 10 karakter.";
    }

    // Validasi Jenis Kelamin
    if (empty($jk)) {
        $errors["jk"] = "Jenis kelamin wajib dipilih.";
    }

    // Validasi Tanggal Lahir
    if (empty($tgl_lahir)) {
        $errors["tgl_lahir"] = "Tanggal lahir wajib diisi.";
    } else {
        $lahir = new DateTime($tgl_lahir);
        $today = new DateTime();
        $umur = $today->diff($lahir)->y;

        if ($umur < 10) {
            $errors["tgl_lahir"] = "Umur minimal 10 tahun.";
        }
    }

    // Validasi Pekerjaan
    if (empty($pekerjaan)) {
        $errors["pekerjaan"] = "Pekerjaan wajib dipilih.";
    }

    // Jika tidak ada error
    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registrasi Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Form Registrasi Anggota Perpustakaan</h3>
                </div>

                <div class="card-body">

                    <form method="POST">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama"
                                class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($nama) ?>">
                            <div class="invalid-feedback">
                                <?= $errors['nama'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email"
                                class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($email) ?>">
                            <div class="invalid-feedback">
                                <?= $errors['email'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="telepon"
                                class="form-control <?= isset($errors['telepon']) ? 'is-invalid' : '' ?>"
                                value="<?= htmlspecialchars($telepon) ?>">
                            <div class="invalid-feedback">
                                <?= $errors['telepon'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat"
                                class="form-control <?= isset($errors['alamat']) ? 'is-invalid' : '' ?>"
                                rows="3"><?= htmlspecialchars($alamat) ?></textarea>
                            <div class="invalid-feedback">
                                <?= $errors['alamat'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label class="form-label d-block">Jenis Kelamin</label>

                            <input type="radio" name="jk" value="Laki-laki"
                                <?= ($jk == "Laki-laki") ? "checked" : "" ?>> Laki-laki

                            <input type="radio" name="jk" value="Perempuan"
                                class="ms-3"
                                <?= ($jk == "Perempuan") ? "checked" : "" ?>> Perempuan

                            <?php if(isset($errors["jk"])): ?>
                                <div class="text-danger small mt-1"><?= $errors["jk"] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir"
                                class="form-control <?= isset($errors['tgl_lahir']) ? 'is-invalid' : '' ?>"
                                value="<?= $tgl_lahir ?>">
                            <div class="invalid-feedback">
                                <?= $errors['tgl_lahir'] ?? '' ?>
                            </div>
                        </div>

                        <!-- Pekerjaan -->
                        <div class="mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <select name="pekerjaan"
                                class="form-select <?= isset($errors['pekerjaan']) ? 'is-invalid' : '' ?>">
                                <option value="">-- Pilih --</option>
                                <option value="Pelajar" <?= ($pekerjaan=="Pelajar")?'selected':'' ?>>Pelajar</option>
                                <option value="Mahasiswa" <?= ($pekerjaan=="Mahasiswa")?'selected':'' ?>>Mahasiswa</option>
                                <option value="Pegawai" <?= ($pekerjaan=="Pegawai")?'selected':'' ?>>Pegawai</option>
                                <option value="Lainnya" <?= ($pekerjaan=="Lainnya")?'selected':'' ?>>Lainnya</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $errors['pekerjaan'] ?? '' ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Daftar Sekarang
                        </button>

                    </form>
                </div>
            </div>

            <!-- Success Output -->
            <?php if($success): ?>
            <div class="card mt-4 shadow border-success">
                <div class="card-header bg-success text-white">
                    Registrasi Berhasil
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                    <p><strong>Telepon:</strong> <?= htmlspecialchars($telepon) ?></p>
                    <p><strong>Alamat:</strong> <?= htmlspecialchars($alamat) ?></p>
                    <p><strong>Jenis Kelamin:</strong> <?= htmlspecialchars($jk) ?></p>
                    <p><strong>Tanggal Lahir:</strong> <?= htmlspecialchars($tgl_lahir) ?></p>
                    <p><strong>Pekerjaan:</strong> <?= htmlspecialchars($pekerjaan) ?></p>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>