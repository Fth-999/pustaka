<?php
require 'koneksi.php';
$judul_halaman = 'Input Anggota';
$menu_aktif    = 'anggota';
require 'layout/header.php';
?>

<h1 class="mb-3">Input Data Anggota</h1>

<form action="proses_anggota.php" method="post">
    <div class="row mb-3">
        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="nim" name="nim" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-4">
            <input type="email" class="form-control" id="email" name="email">
        </div>
    </div>
    <div class="row mb-3">
        <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="no_hp" name="no_hp">
        </div>
    </div>

    <input type="submit" value="Simpan" name="submit" class="btn btn-primary">
    <a href="anggota.php" class="btn btn-secondary">Kembali</a>
</form>

<?php require 'layout/footer.php'; ?>
